<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Role;
use App\Models\ProjectTask;
use App\Models\Employee;
use App\Notifications\ProjectUpdated;
use App\Notifications\TaskCreated;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class ProjectsController extends Controller
{


        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Fetch project
     * (You can extract this to repository method).
     * @param $id
     *
     * @return mixed
     */
    public function getProjectById($id)
    {
        return Project::whereid($id)->firstOrFail();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        $user = Auth::user();

        $data = [
            'user'             => $user,
            'projects'          => $projects,
        ];

        return view('show-projects')->with($data);
    }

   /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if($user->user_role->role_id != 1) {
            return back();
        }

        $data = [
            'user'             => $user,

        ];
        return view('create-project')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(Auth::user()->user_role->id != 1) {
            return back();
        }
        
        $validator = Validator::make($request->all(),
        [
            'name'                  => ['required','regex:/^[A-Z]([a-zA-Z0-9]|[- @\.#&!])*$/', 'min: 3','max:32','unique:projects'],
            'description'           => ['required','regex:/^[a-zA-Z\d\s\-\,\#\.\+]+$/', 'min: 3', 'max: 1500'],
            'deadline'              => 'required|date|after:now|before:1 year',
            'budget'                => ['required','regex:/^\d{1,9}+(\.\d{1,2})?$/'],
            'instructions'           => ['required', 'min: 3', 'max: 2000'],
            'currency'               => ['required', 'min: 2', 'max: 3'],
        ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
    
        $project = Project::create([
            'name'                  => $request->input('name'),
            'description'           => $request->input('description'),
            'instruction'          => $request->input('instructions'),
            'currency'              => $request->input('currency'),
            'budget'                => $request->input('budget'),
            'deadline'              => $request->input('deadline'),
            'user_id'               => $user->id,
        ]);
        
        $project->save();

        $data = [
            'user'             => $user,
            'project'          => $project,

        ];

        return back()->with($data);

    }      //

 /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $project = $this->getProjectById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $projects = Project::all();

        $user = Auth::user();

        $user_role = Role::where('id', $user->user_role->role_id)->first();

        $data = [
            'user'             => $user,
            'project'          => $project,
        ];

        return view('show-project')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            try {
                $project = $this->getProjectById($id);
            } catch (ModelNotFoundException $exception) {
                abort(404);
            }
    
            $user = Auth::user();

            $check = false;

            foreach ($user->supervisor as $supervisor) {
                if($supervisor->id==$project->id)
                    $check = true;
            }

            if ($check==false)
                return back();
    
            $data = [
                'project'         => $project,
                'user'            => $user,
            ];
    
            return view('edit-project')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $project = $this->getProjectById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $user = Auth::user();

        $check=false;

        foreach ($user->supervisor as $supervisor) {
            if($supervisor->id==$project->id)
                $check = true;
        }

        if ($check==false)
            return back();


        $validator = Validator::make($request->all(),
        [
            'name'                  => ['sometimes','required','regex:/^[A-Z]([a-zA-Z0-9]|[- @\.#&!])*$/', 'min: 3','max:32'],
            'description'           => ['required','regex:/^[a-zA-Z\d\s\-\,\#\.\+]+$/', 'min: 3', 'max: 1500'],
            'budget'                => ['required','regex:/^\d{1,9}+(\.\d{1,2})?$/'],
            'instruction'          => ['required', 'min: 3', 'max: 2000'],
            'status'               => ['required', 'boolean'],
        ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $input = Input::only('name', 'description', 'instruction', 'budget', 'status');

        $project->fill($input)->save();

        $project->supervisor->notify(new ProjectUpdated($project));

        foreach($project->employees as $employee) {
            $employee->user->notify(new ProjectUpdated($project));
        }

        return redirect('projects/'.$project->id.'/edit')->with('success', trans('Project has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $project = $this->getProjectById($id);
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }

        $check=false;

        $user=Auth::user();

        foreach ($user->supervisor as $supervisor) {
            if($supervisor->id==$project->id)
                $check = true;
        }

        if ($check==false)
            return back();

        $project->delete();
        foreach($project->tasks as $task){
            $task->delete();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function task(Request $request, $id)
    {
            try {
                $project = $this->getProjectById($id);
            } catch (ModelNotFoundException $exception) {
                abort(404);
            }
    
            $user = Auth::user();

            $check = false;

            foreach ($user->supervisor as $supervisor) {
                if($supervisor->id==$project->id)
                    $check = true;
            }

            if ($check==false)
                return back();
    
                
            $data = [
                'project'         => $project,
                'user'            => $user,
                'check'           => $check,
            ];

            $project->task=ProjectTask::create([
                'task'                  => $request->input('task'),
                'project_id'            => $project->id,
            ]);

            $project->task->save();

            $project_users = Employee::where('project_id', $project->id)->get();
            
            $project->supervisor->notify(new ProjectUpdated($project));

            foreach($project->employees as $employee) {
                $employee->user->notify(new ProjectUpdated($project));
            }

            return redirect('projects/'.$project->id)->with('success', trans('Task added'));
    }
}
