@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Nuevo Ingreso</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif
	</div>
</div>

{!!Form::open(array('url'=>'compras/ingreso','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="form-group">
			<label for="proveedor">Proveedor</label>
			<select name="idproveedor" id="idproveedor" class="form-control selectpicker" data-live-search="true">
				@foreach($personas as $persona)
				<option value="{{$persona->idpersona}}">{{$persona->nombre}}</option>
				@endforeach
			</select>
		</div>
	</div>
	
	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
		<div class="form-group">
			<label>Tipo de Comprobante</label>
			<select name="tipo_comprobante" class="form-control">
				<option value="Boleta">Boleta</option>
				<option value="Factura">Factura</option>
				<option value="Ticket">Ticket</option>
			</select>
		</div>
	</div>

	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
		<div class="form-group">
			<label for="serie_comprobante">Serie de comprobante</label>
			<input type="text" name="serie_comprobante" value="{{old('serie_comprobante')}}" class="form-control" placeholder="Serie de comprobante...">
		</div>
	</div>

	<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
		<div class="form-group">
			<label for="serie_comprobante">Número de comprobante</label>
			<input type="text" name="num_comprobante" required value="{{old('num_comprobante')}}" class="form-control" placeholder="Número de comprobante...">
		</div>
	</div>
</div>


<div class="row">
	<div class="panel panel-primary">
		<div class="panel-body">
			<div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
				<div class="form-group">
					<label>Artículo</label>
					<select name="pidarticulo" class="form-control selectpicker" id="pidarticulo" data-live-search="true">
						@foreach($articulos as $articulo)
						<option value="{{$articulo->idarticulo}}">{{$articulo->articulo}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
				<div class="form-group">
					<label for="cantidad">Cantidad</label>				
					<input type="number" name="pcantidad" id="pcantidad" class="form-control" placeholder="Cantidad...">
				</div>
			</div>

			<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
				<div class="form-group">
					<label for="precio_compra">Precio Compra</label>				
					<input type="number" name="pprecio_compra" id="pprecio_compra" class="form-control" placeholder="Precio de compra...">
				</div>
			</div>

			<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
				<div class="form-group">
					<label for="cantidad">Precio Venta</label>				
					<input type="number" name="pprecio_venta" id="pprecio_venta" class="form-control" placeholder="Precio de venta...">
				</div>
			</div>

			<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
				<div class="form-group">
					<button type="button" id="bt_add" class="btn btn-primary">Agregar</button>
				</div>
			</div>

			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
				<table id="detalles" class="table table-striped table-bordered table-condensed table-hover" >
					<thead style="background-color: #17B4E7">
						<th>Opciones</th>
						<th>Artículo</th>
						<th>Cantidad</th>
						<th>Precio Compra</th>
						<th>Precio Venta</th>
						<th>Subtotal</th>
					</thead>
					<tfoot>
						<th>TOTAL</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th><h4 id="total">$ 0.00</h4></th>
					</tfoot>
					<tbody>
						
					</tbody>
				</table>
			</div>
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" >
				<div class="form-group" >
					<button class="btn btn-primary" type="reset" id="limpiarTabla">Limpiar</button>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12" >
		<div class="form-group" >
			<input name="_token" value="{{csrf_token()}}" type="hidden"></input>
			<button class="btn btn-primary" type="submit" id="guardar">Guardar</button>	
			<button class="btn btn-danger" type="reset"><a href="{{URL::action('IngresoController@index')}}" title="Cancelar y volver atrás" style="color: white ; " >Cancelar</a></button>
		</div>
	</div>

</div>

{!!Form::close()!!}

@push('scripts')

<script type="text/javascript">
	
	$(document).ready(function(){
		$('#bt_add').click(function(){
			agregar();
		});
		$('#limpiarTabla').click(function(){
			limpiar_tabla();
		});

	});

	var cont=0;
	total=0;
	subtotal=[];

	$('#guardar').hide();
	$('#limpiarTabla').hide();


	function agregar(){
		idarticulo=$("#pidarticulo").val();
		articulo=$("#pidarticulo option:selected").text();
		cantidad=$("#pcantidad").val();
		precio_compra=$("#pprecio_compra").val();
		precio_venta=$("#pprecio_venta").val();

		if(idarticulo!="" && cantidad!="" && cantidad>0 && precio_compra!="" && precio_venta!="")
		{
			subtotal[cont]=(cantidad*precio_compra);
			total= total+subtotal[cont];
			var fila='<tr class="selected" id="fila'+cont+'">' 
			+'<td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');"> X </button></td>'
			+'<td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td>' 
			+'<td><input type="number" name="cantidad[]" value="'+cantidad+'"></td>' 
			+'<td><input type="number" name="precio_compra[]" value="'+precio_compra+'"></td>' 
			+'<td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td>' 
			+'<td>'+subtotal[cont]+'</td>' 
			+'</tr>';


			cont++;
			limpiar();
			$("#total").html("$ "+total);
			evaluar();
			$("#detalles").append(fila);
		}
		else
		{
			alert("Error al ingresar el detalle de ingreso, revise los detalles de articulo")
		}
	}

	function limpiar() {
		$("#pcantidad").val("");
		$("#pprecio_venta").val("");
		$("#pprecio_compra").val("");
	}

	function limpiar_tabla() {

		cont=0;
		total=0;
		subtotal=[];

		document.getElementById("detalles").innerHTML='<thead style="background-color: #17B4E7"><th>Opciones</th><th>Artículo</th><th>Cantidad</th><th>Precio Compra</th> <th>Precio Venta</th><th>Subtotal</th></thead><tfoot> <th>TOTAL</th><th></th><th></th><th></th><th></th><th><h4 id="total">$ 0.00</h4></th></tfoot><tbody></tbody>';

		$('#limpiarTabla').hide();
		$('#guardar').hide();
	}

	function evaluar() {
		if(total>0){
			$("#limpiarTabla").show();
			$("#guardar").show();
		}
		else{
			$("#limpiarTabla").hide();
			$("#guardar").hide();
		}
	}

	function eliminar(index){
		total= total-subtotal[index];
		$("#total").html("$ "+total);
		$("#fila"+index).remove();
		evaluar();
	}

</script>

@endpush

@endsection