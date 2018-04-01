@extends('layouts.admin')
@section('contenido')

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Listado de Categorías</h3>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >
			@include('almacen.categoria.search')
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 bottom-right" >
			<a href="categoria/create"><button class="btn btn-success">Nuevo</button></a>   
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bottom-right" >
			<a href="categoria/report_1" class="pull-right" >
				<button class="btn btn-success"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
			</a>
			<a href="categoria/report_2" class="pull-right" >
				<button class="btn btn-danger"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
			</a>
			<a href="categoria/report_3" class="pull-right" >
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
					<tr>
						<th>Id</th>
						<th>Nombre</th>
						<th>Descripción</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($categorias as $cat)
					<tr>
						<td>{{$cat->idcategoria}}</td>
						<td>{{$cat->nombre}}</td>
						<td>{{$cat->descripcion}}</td>
						<td> 
							<a href="{{URL::action('CategoriaController@edit',$cat->idcategoria)}}"><button class="btn btn-info">Editar</button> </a> 
							<a href="" data-target="#modal-delete-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button> </a>
						</td>
					</tr>
					@include('almacen.categoria.modal')

					@endforeach
				</tbody>
			</table>
		</div>
		{{$categorias->render()}}		
	</div>
</div>
@endsection

