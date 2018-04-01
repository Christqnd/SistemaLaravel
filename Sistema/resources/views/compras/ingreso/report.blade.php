<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Listado de ingresos</title>

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
							<th>Proveedor</th>
							<th>Comprobante</th>
							<th>Impuesto</th>
							<th>Total</th>
							<th>Estado</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($ingresos as $ing)
						<tr>
							<td>{{$contador++}}</td>
							<td>{{$ing->fecha_hora}}</td>
							<td>{{$ing->nombre}}</td>
							<td>{{$ing->tipo_comprobante." : ".$ing->serie_comprobante." : ".$ing->num_comprobante}}</td>
							<td>{{$ing->impuesto}}</td>
							<td>{{$ing->total}}</td>
							<td>{{$ing->estado}}</td>
						</tr>
						@endforeach
					</tbody>			
				</table>
			</div>
		</div>
	</div>
</body>
</html>