@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        User Edit
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('user.update', [$user->id]) }}" method="post">

                            {{ method_field('put') }}

                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name">{{ __('User name') }}:</label>
                                <input id="name" class="form-control" type="text" name="name"
                                       value="{{ old('name', $user->name) }}">
                                @if($errors->has('name'))
                                    <div class="alert-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">{{ __('Email') }}:</label>
                                <input id="email" class="form-control" type="text" name="email"
                                       value="{{ old('email', $user->email) }}">
                                @if($errors->has('email'))
                                    <div class="alert-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<label for="email">{{ __('Password') }}:</label>--}}
                                {{--<input id="password" class="form-control" type="text" name="password"--}}
                                       {{--value="{{ old('password', $user->password) }}">--}}
                                {{--@if($errors->has('password'))--}}
                                    {{--<div class="alert-danger">{{ $errors->first('password') }}</div>--}}
                                {{--@endif--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <input class="btn btn-success" type="submit" value="{{ __('Save') }}">
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection