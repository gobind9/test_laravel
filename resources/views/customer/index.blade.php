@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>User Management </h1>
		<a href="{{ route('user.create') }}" class="btn btn-success">Add User</a>
        {!! Form::open(['url' => 'user', 'method'=>'get', 'class'=>'form-inline']) !!}
            <div class="form-group {!! $errors->has('q') ? 'has-error' : '' !!}">
              {!! Form::text('q', isset($q) ? $q : null, ['class'=>'form-control', 'placeholder' => 'Type user name...']) !!}
              {!! $errors->first('q', '<p class="help-block">:message</p>') !!}
            </div>

          {!! Form::submit('Search', ['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr class="bg-info">
              <th>Name</th>
              <th>Email</th>
              <th>Password</th>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email}}</td>
              <td>{{ $user->password}}</td>
              <td>
                
          
				 {!! Form::model($user, ['route' => ['user.destroy', $user], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
				<a href="{{route('user.edit',$user->id)}}" class="btn btn-warning">Update</a>
              |
                  {!! Form::submit('delete', ['class'=>'btn btn-info btn-danger js-submit-confirm']) !!}
                {!! Form::close()!!}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $users->links() !!}
      </div>
    </div>
  </div>
@endsection
