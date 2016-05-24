@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Product</div>
                <div class="panel-body">
					{!! Form::open(['url' => 'products/store']) !!}
					<div class="form-group">
						{!! Form::label('Product Name', 'Product Name:') !!}
						{!! Form::text('name',null,['class'=>'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('Unit of Measure', 'Unit of Measure:') !!}						
					
						
						
						{!! Form::select('id_uom', $measure_units, null, ['class' => 'form-control']) !!}
						
					</div>
					<div class="form-group">
						{!! Form::label('Price', 'Price:') !!}
						{!! Form::text('price_per_unit',null,['class'=>'form-control']) !!}
					</div>
					<div class="form-group">
						{!! Form::label('Quantity', 'Quantity:') !!}
						{!! Form::text('qty_in_stock',null,['class'=>'form-control']) !!}
					</div>  
					<div class="form-group">
						{!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
					</div>
					{!! Form::close() !!}
				</div>
            </div>
        </div>
    </div>
</div>
@endsection