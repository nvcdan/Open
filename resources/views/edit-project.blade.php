@extends('layouts.app')

@section('content')
<div class="container mt-n5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                        <form method="POST" action="{{ url('projects/'.$project->id) }}">
                            @method('PUT')
                            @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <h4>{{ __('Project Details') }}</h4>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="pt-3">
                                            <div>
                                                <label for="name">Project Name</label>
                                                <input id="name" type="text" value="{{$project->name}}" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{ __('Project Name') }}" required autofocus>
                            
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                        <div class="col-sm-6">
                                            <div class="pt-3">
                                                <div>
                                                   <label for="budget">Budget</label>
                                                    <input id="budget" value="{{$project->budget}}" type="text" class="form-control{{ $errors->has('budget') ? ' is-invalid' : '' }}" name="budget" value="{{ old('budget') }}" placeholder="{{ __('Budget') }}" required autofocus>
                                                    @if ($errors->has('budget'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('budget') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="pt-3">
                                            <div>
                                                <label for="description">Description</label>
                                                <textarea id="description"  type="text" name="description" max="1500" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" required autofocus placeholder="Describe the project">{{$project->description}}</textarea>
                                            </div>
                                            @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="pt-3">
                                            <div>
                                                <label for="name">Instructions</label>
                                                <textarea id="instruction" type="text" name="instruction" max="1500" class="form-control {{ $errors->has('instructions') ? ' is-invalid' : '' }}" required autofocus placeholder="Enter the instructions for the project">{{$project->instruction}}</textarea>
                                            </div>
                                            @if ($errors->has('instruction'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('instruction') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="pt-3">
                                            <div>
                                                <label for="status">Status</label>
                                                <select class="form-control" id="status" name="status">
                                                    <option value="1">In progress</option>    
                                                    <option value="0">Finished</option>
                                                </select>                        
                                            </div>
                                            @if ($errors->has('instruction'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('instruction') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            <button class="btn btn-success mt-3" type="submit">Update</button>
                        </form>
                    </div>
            </div>
        </div>       
    </div>
</div>
@endsection
