@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>User Management </h1>
		<a href="{{ route('user.create') }}" class="btn btn-success">Add User</a>

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
