<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Listado de Ventas</title>

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
							<th>N°</th>
							<th>Fecha</th>
							<th>Cliente</th>
							<th>Comprobante</th>
							<th>Impuesto</th>
							<th>Total</th>
							<th>Estado</th>

						</tr>
					</thead>
					<tbody>
						@foreach ($ventas as $ven)
						<tr>
							<td>{{$contador++}}</td>
							<td>{{$ven->fecha_hora}}</td>
							<td>{{$ven->nombre}}</td>
							<td>{{$ven->tipo_comprobante." : ".$ven->serie_comprobante." - ".$ven->num_comprobante}}</td>
							<td>{{$ven->impuesto}}</td>
							<td>{{$ven->total_venta}}</td>
							<td>{{$ven->estado}}</td>
						</tr>
						@endforeach
					</tbody>			
				</table>
			</div>
		</div>
	</div>
</body>
</html>