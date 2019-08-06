@extends('layouts.app')

@section('content')
<div class="container mt-n5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('General Info' )}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif 
                    You are logged in as {{ $user->name }}!<br>
                    Your role is <span class="badge badge-warning">{{ $user_role->name }}</span>!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
