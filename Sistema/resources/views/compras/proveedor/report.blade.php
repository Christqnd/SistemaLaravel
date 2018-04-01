<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Listado de Proveedores</title>


</head>
<body>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<tr>
							<th>N°</th>
							<th>Nombre</th>
							<th>Tipo de doc</th>
							<th>Número de doc</th>
							<th>Teléfono</th>
							<th>Email</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($proveedores as $per)
						<tr>
							<td>{{$contador++}}</td>
							<td>{{$per->nombre}}</td>
							<td>{{$per->tipo_documento}}</td>
							<td>{{$per->num_documento}}</td>
							<td>{{$per->telefono}}</td>
							<td>{{$per->email}}</td>
						</tr>
						@endforeach
					</tbody>			
				</table>
			</div>
		</div>
	</div>
</body>
</html>