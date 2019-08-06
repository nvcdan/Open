@extends('layouts.app')

@section('content')
<div class="container mt-n5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                            <h2>{{$project->name}}</h2>
                            @if($project->supervisor->id==$user->id) <div class="alert alert-success" role="alert">
                                    You are the supervisor!
                                </div> @endif
                        <div class="m-3">
                            <p class="h5 text-success font-weight-bold">Description</p>
                            <span>{{$project->description}}</span>
                        </div>
                        <div class="m-3">
                            <p class="h5 text-success font-weight-bold">Instructions</p>
                            <span>{{$project->instruction}}</span>
                        </div>
                        <div class="m-3">
                            <p class="h5 text-success font-weight-bold">Deadline</p>
                            <span>{{$project->deadline}}</span>
                        </div>
                        <div class="m-3">
                            <p class="h5 text-success font-weight-bold">Budget</p>
                            <span>{{$project->budget." ".$project->currency}}</span>
                        </div>
                        <div class="m-3">
                                <p class="h5 text-success font-weight-bold">Status</p>
                                @if($project->status==1)<span class="badge badge-info">In progress</span>@else <span class="badge badge-success">Finished</span>@endif
                        </div>
                        <div class="m-3">
                                <p class="h5 text-success font-weight-bold">Supervisor</p>
                                <span>{{ $project->supervisor->first_name." ".$project->supervisor->last_name }}</span>
                        </div>
                        <div class="m-3">
                        @if($project->supervisor->id == $user->id) <a href="{{url('/projects/'.$project->id.'/edit')}}" class="btn btn-warning">Update project info</a>
                        <form method="POST" action="{{ url('projects/'.$project->id) }}">
                            @method('DELETE')
                            @csrf
                            <input type="hidden" id="project_id" name="project_id" value="{{$project->id}}">
                            <button class="mt-3 btn btn-danger" type="submit">Delete Project</button>
                        </form>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        @foreach ($project->tasks as $task)
                            <div class="alert @if($task->status == false) alert-warning @else alert-success @endif" role="alert">
                                {{ $task->task }} <small>({{$task->updated_at}})</small>
                            </div>
                        @endforeach

                        @if ($project->supervisor->id == $user->id)
                        <button type="button" class="btn btn-light" data-toggle="modal" data-target="#taskAdd">
                                Add new tasks
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if ($project->supervisor->id == $user->id && $project->employees->count() != 0)
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                            <table class="table">
                                <thead class="thead-dark">
                                  <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Responsability</th>
                                    <th scope="col">Job Title</th>
                                    <th scope="col">Settings</th>
                                  </tr>
                                </thead>
                                <tbody>
                                @foreach($project->employees as $employee)
                                  <tr>
                                  <td>{{$employee->user->first_name." ".$employee->user->last_name}}</td>
                                    <td>{{$employee->responsability}}</td>
                                    <td>{{$employee->job_title}}</td>
                                    <td><settings-component :current-user-id="{{ $employee->user->id }}"></settings-component></td>
                                  </tr>
                                @endforeach
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        </div>
    </div>
</div>
@include('partials.add-task-modal')
@endsection


