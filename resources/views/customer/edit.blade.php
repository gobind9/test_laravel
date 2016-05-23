@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit User ({!!$user->name!!})</div>
                <div class="panel-body">
                  <!--  /*<form class="form-horizontal" role="form" method="POST" action="{{ url('/user/store') }}">*/--->
					 {!! Form::model($user, ['route' => ['user.update', $user], 'method' =>'patch','class'=>'form-horizontal'])!!}
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                           <!-- <label class="col-md-4 control-label">Name</label>-->
							{!! Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                <!--<input type="text" class="form-control" name="name" value="{{ old('name') }}">--->
								 {!! Form::text('name', null, array('required', 'class'=>'form-control')) !!}

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							{!! Form::label('email', 'E-Mail Address', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('email', null, array('required email', 'class'=>'form-control')) !!}

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							{!! Form::label('password', 'Password', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                 {!! Form::text('password', null, array('required', 'class'=>'form-control',  'readonly' => true)) !!}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Edit User
                                </button>
                            </div>
                        </div>
						{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
