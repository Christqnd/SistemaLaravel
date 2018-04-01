<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Listado de categorías</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-select.min.css">
	<link rel="stylesheet" href="css/AdminLTE.min.css">
	<link rel="stylesheet" href="css/_all-skins.min.css">

</head>
<body>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<tr>
							<th> N° </th>
							<th> Nombre </th>
							<th> Descripción </th>
						</tr>
					</thead>
					<tbody>
						@foreach ($categorias as $cat)
						<tr>
							<td> {{$contador++}} </td>
							<td> {{$cat->nombre}} </td>
							<td> {{$cat->descripcion}} </td>
						</tr>
						@endforeach
					</tbody>			
				</table>
			</div>
		</div>
	</div>
</body>
</html>