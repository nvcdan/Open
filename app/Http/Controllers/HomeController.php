<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Role;
use App\Models\Project;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();
        $projects = Project::all()->take(5);
        $user_role = Role::where('id', $user->user_role->role_id)->first();

        $data = [
            'user'         => $user,
            'user_role'    => $user_role,
            'projects'     => $projects,
        ];

        return view('home')->with($data);
    }
}
