@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Customer ({!!$user->name!!})</div>
                <div class="panel-body">
                  <!--  /*<form class="form-horizontal" role="form" method="POST" action="{{ url('/user/store') }}">*/--->
					 {!! Form::model($user, ['route' => ['customer.update', $user], 'method' =>'patch','class'=>'form-horizontal'])!!}
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
						
						<div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
							{!! Form::label('address1', 'Address 1', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::textarea('address1',null,['class'=>'form-control', 'rows' => 2, 'cols' => 40]) !!}

                                @if ($errors->has('address1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
							{!! Form::label('address2', 'Address 2', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                               {!! Form::textarea('address2',null,['class'=>'form-control', 'rows' => 2, 'cols' => 40]) !!}

                                @if ($errors->has('address2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
							{!! Form::label('city', 'City', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('city', null, array('required', 'class'=>'form-control')) !!}

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						
						<div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
							{!! Form::label('country', 'Country', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                         
								{!! Form::select('country', array(''=>'Select Country','INDIA'=>'India','CHINA'=>'China','NEPAL'=>'Nepal','USA'=>'USA','UK'=>'UK'),null, array('required','class' => 'form-control')) !!}

                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('credit_limit') ? ' has-error' : '' }}">
							{!! Form::label('credit_limit', 'Credit Limit', ['class' => 'col-md-4 control-label']) !!}

                            <div class="col-md-6">
                                {!! Form::text('credit_limit', null, array('required', 'class'=>'form-control')) !!}

                                @if ($errors->has('credit_limit'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('credit_limit') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Edit Customer
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
