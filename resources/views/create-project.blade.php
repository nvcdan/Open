@extends('layouts.app')

@section('content')
<div class="container mt-n5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create New Project' )}}</div>
                <div class="card-body">
                        <form method="POST" action="{{ url('projects') }}">
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
                                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{ __('Project Name') }}" required autofocus>
                            
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
                                        <div class="col-sm-4">
                                            <div class="pt-3">
                                                <div>
                                                    <input id="budget" type="text" class="form-control{{ $errors->has('budget') ? ' is-invalid' : '' }}" name="budget" value="{{ old('budget') }}" placeholder="{{ __('Budget') }}" required autofocus>
                                                    @if ($errors->has('budget'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('budget') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="pt-3">
                                                <div>
                                                    <input id="currency" type="text" class="form-control{{ $errors->has('currency') ? ' is-invalid' : '' }}" name="currency" value="{{ old('currency') }}" placeholder="{{ __('Currency') }}" required autofocus>
                                
                                                    @if ($errors->has('currency'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('currency') }}</strong>
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
                                                <textarea id="description" type="text" name="description" max="1500" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" required autofocus placeholder="Describe the project">{{ old('description') }}</textarea>
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
                                                <textarea id="instructions" type="text" name="instructions" max="1500" class="form-control {{ $errors->has('instructions') ? ' is-invalid' : '' }}" required autofocus placeholder="Enter the instructions for the project">{{ old('instructions') }}</textarea>
                                            </div>
                                            @if ($errors->has('instructions'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('instructions') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="pt-3">
                                            <div>
                                        <input id="deadline" type="date" class="form-control{{ $errors->has('currency') ? ' is-invalid' : '' }}" name="deadline" value="{{ old('deadline') }}" required autofocus>                                            </div>
                                            @if ($errors->has('deadline'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('deadline') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            <button class="btn btn-success mt-3" type="submit">Submit</button>
                        </form>
                    </div>
            </div>
        </div>       
    </div>
</div>
@endsection
