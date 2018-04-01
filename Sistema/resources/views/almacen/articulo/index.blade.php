@extends('layouts.admin')
@section('contenido')

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Listado de Articulos</h3>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 " >
			@include('almacen.articulo.search')
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 bottom-right" >
			<a href="articulo/create"><button class="btn btn-success">Nuevo</button></a>   
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bottom-right" >
			<a href="articulo/report_1" class="pull-right" >
				<button class="btn btn-success"> <i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
			</a>
			<a href="articulo/report_2" class="pull-right" >
				<button class="btn btn-danger"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
			</a>
			<a href="articulo/report_3" class="pull-right" >
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
						<th>Código</th>
						<th>Categorí­a</th>
						<th>Stock</th>
						<th>Imagen</th>
						<th>Estado</th>
						<th>Opciones</th>
					</tr>
				</thead>
								<tbody>
					@foreach ($articulos as $art)
					<tr>
						<td>{{$art->idarticulo}}</td>
						<td>{{$art->nombre}}</td>
						<td>{{$art->codigo}}</td>
						<td>{{$art->categoria}}</td>
						<td>{{$art->stock}}</td>
						<td>
							<img src="{{asset('imagenes/articulos/'.$art->imagen)}}" alt="{{$art->nombre}}" height="100" width="100" class="img-thumbnail">
						</td>
						<td>{{$art->estado}}</td>
						<td> 
							<a href="{{URL::action('ArticuloController@edit',$art->idarticulo)}}"><button class="btn btn-info">Editar</button> </a> 
							<a href="" data-target="#modal-delete-{{$art->idarticulo}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button> </a>
						</td>
					</tr>
					@include('almacen.articulo.modal')
					@endforeach
				</tbody>
			</table>
		</div>
		{{$articulos->render()}}		
	</div>
</div>
@endsection