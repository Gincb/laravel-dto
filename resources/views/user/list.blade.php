@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Users List
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>

                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name}}</td>
                                    <td>{{ $user->email}}</td>
                                    <td style="display: flex">
                                        <a class="btn btn-sm btn-dark" href="{{ route('user.edit', [$user->id]) }}">{{ __('Edit') }}</a>&nbsp;
                                        <form action="{{ route('user.destroy', [$user->id]) }}" method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <input class="btn btn-sm btn-danger" type="submit" value="Delete">
                                        </form>
                                    </td>
                                </tr>

                            @endforeach

                        </table>
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection