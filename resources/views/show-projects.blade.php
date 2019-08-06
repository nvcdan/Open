@extends('layouts.app')

@section('content')
<div class="container mt-n5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">@if($user->user_role->role_id == 1){{ __('Projects' )}}@else{{ __('My Projects' )}}@endif</div>
            <div class="card-body">
                @if($user->user_role->role_id == 1)
                <a href="{{url('/projects/create')}}" class="btn btn-success">Add New Project</a>
                    <table class="table table-hover table-sm mt-2">
                        <thead class="thead-light"> 
                            <tr>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Category') }}</th>
                            <th scope="col">{{ __('Budget') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col"><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                                <tr>
                                <td class=" @if($project->supervisor->id==$user->id) text-primary @endif ">{{$project->name}} @if($project->supervisor->id==$user->id) <i class="fa fa-home"></i> @endif</td>
                                <td>{{ str_limit($project->description, $limit = 20, $end = '..') }}</td>
                                <td class="text-success">{{$project->budget." ".$project->currency}}</td>
                                <td>@if($project->status==1)<span class="badge badge-info">In progress</span>@else <span class="badge badge-success">Finished</span>  @endif</td>
                                <td><a href="{{ url('/projects/'.$project->id) }}">View</a></td>
                                </tr>
                            @endforeach                         
                        </tbody>
                    </table>
                @else
                <table class="table table-hover table-sm mt-2">
                    @foreach($projects as $project)
                        @if($project->employee == $user->employee)
                        <thead class="thead-light"> 
                            <tr>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Category') }}</th>
                            <th scope="col">{{ __('Budget') }}</th>
                            <th scope="col">{{ __('Status') }}</th>
                            <th scope="col"><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        @endif
                    @endforeach
                    <tbody>
                        @foreach($projects as $project)
                            @if($project->employee == $user->employee)
                                <tr>
                                <td class=" @if($project->supervisor->id==$user->id) text-primary @endif ">{{$project->name}} @if($project->supervisor->id==$user->id) <i class="fa fa-home"></i> @endif</td>
                                <td>{{ str_limit($project->description, $limit = 20, $end = '..') }}</td>
                                <td class="text-success">{{$project->budget." ".$project->currency}}</td>
                                <td>@if($project->status==1)<span class="badge badge-info">In progress</span>@else <span class="badge badge-success">Finished</span>  @endif</td>
                                <td><a href="{{ url('/projects/'.$project->id) }}">View</a></td>
                                </tr>
                            @else
                                <div class="alert alert-light" role="alert">
                                    You have no projects!
                                </div>
                            @endif
                        @endforeach                         
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection