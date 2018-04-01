@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Listado de Ventas</h3>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >
			@include('ventas.venta.search')
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 bottom-right" >
			<a href="venta/create"><button class="btn btn-success">Nuevo</button></a>   
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bottom-right" >
			<a href="venta/report_1" class="pull-right" >
				<button class="btn btn-success"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
			</a>
			<a href="venta/report_2" class="pull-right" >
				<button class="btn btn-danger"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
			</a>
			<a href="venta/report_3" class="pull-right" >
				<button class="btn btn-primary"> <i class="fa fa-file-word-o" aria-hidden="true"></i></button>
			</a>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Comprobante</th>
					<th>Impuesto</th>
					<th>Total</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
				@foreach ($ventas as $ven)
				<tr>
					<td>{{$ven->fecha_hora}}</td>
					<td>{{$ven->nombre}}</td>
					<td>{{$ven->tipo_comprobante." : ".$ven->serie_comprobante." - ".$ven->num_comprobante}}</td>
					<td>{{$ven->impuesto}}</td>
					<td>{{$ven->total_venta}}</td>
					<td>{{$ven->estado}}</td>
					<td> 
						<a href="{{URL::action('VentaController@show',$ven->idventa)}}"><button class="btn btn-info">Detalles</button> </a> 
						<a href="" data-target="#modal-delete-{{$ven->idventa}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button> </a>
					</td>
				</tr>
				@include('ventas.venta.modal')
				@endforeach
			</table>
		</div>
		{{$ventas->render()}}		
	</div>
</div>
@endsection

