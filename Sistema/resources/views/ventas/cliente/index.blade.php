@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Listado de Clientes</h3>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >
			@include('ventas.cliente.search')
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 bottom-right" >
			<a href="cliente/create"><button class="btn btn-success">Nuevo</button></a>   
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bottom-right" >
			<a href="cliente/report_1" class="pull-right" >
				<button class="btn btn-success"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
			</a>
			<a href="cliente/report_2" class="pull-right" >
				<button class="btn btn-danger"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
			</a>
			<a href="cliente/report_3" class="pull-right" >
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
					<th>Id</th>
					<th>Nombre</th>
					<th>Tipo de doc</th>
					<th>Número de doc</th>
					<th>Teléfono</th>
					<th>Email</th>
					<th>Opciones</th>
				</thead>
				<tbody>
					@foreach ($personas as $per)
					<tr>
						<td>{{$per->idpersona}}</td>
						<td>{{$per->nombre}}</td>
						<td>{{$per->tipo_documento}}</td>
						<td>{{$per->num_documento}}</td>
						<td>{{$per->telefono}}</td>
						<td>{{$per->email}}</td>
						<td> 
							<a href="{{URL::action('ClienteController@edit',$per->idpersona)}}"><button class="btn btn-info">Editar</button> </a> 
							<a href="" data-target="#modal-delete-{{$per->idpersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button> </a>
						</td>
					</tr>
					@include('ventas.cliente.modal')

					@endforeach
				</tbody>
			</table>
		</div>
		{{$personas->render()}}		
	</div>
</div>
@endsection

