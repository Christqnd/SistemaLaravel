@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<h3>Nueva Artículo</h3>
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

{!!Form::open(array('url'=>'almacen/articulo','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
{{Form::token()}}
<div class="row">
	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="descripcion">Descripción</label>
			<input type="text" name="descripcion" value="{{old('descripcion')}}" class="form-control" placeholder="Descripción del artículo...">
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label for="stock">Stock</label>
			<input type="text" name="stock" required value="{{old('stock')}}" class="form-control" placeholder="Stock del artículo...">
		</div>
	</div>


	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<label>Categoria</label>
			<select name="idcategoria" class="form-control">
				@foreach($categorias as $cat)
				<option value="{{$cat->idcategoria}}">{{$cat->nombre}}</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 ">
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 " >
			<div class="form-group">
				<label for="codigo">Código</label>
				<input type="text" name="codigo" id="codigo" required value="{{old('codigo')}}" class="form-control" placeholder="Código del artículo...">
			</div>
			<div class="form-group">
				<button class="btn  btn-info" id="btn_generar_codigo" type="button" onclick="generarBarras()">Generar código de barras</button>
			</div>
		</div>
		
		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 panel panel-default" style="color: white ;background-color: #2F2F2F ;width: 260px; height: 230px">
			<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12" id="code">
				<div class="form-group">
					<label for="codigo" align="center" style="width: 240px; margin: 0 auto;" >Código Generado</label>
					<div  width="230" height="150" style="margin-left: -17px">
						<div id="barcode"></div>
					</div>
				</div>
			</div>
			<div class="form-group" align="center" style="width: 240px; margin: 0 auto;">
				<button class="btn btn-primary" id="btn_imprimir_codigo" onclick="imprSelec('code')" type="button">Imprimir codigo</button>
			</div>
		</div>
	</div>

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
				<div class="form-group">
					<label for="imagen">Imagen</label>
					<input type="file" name="imagen" class="form-control" id="files" >
				</div>
			</div>

			<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 panel panel-default" style="color: white ;background-color: #2F2F2F;width: 260px; height: 230px ;" >
				<label for="codigo" align="center" style="width: 260px; margin: 0 auto;" >Vista Previa</label>
				<output id="list" style="width: 100%; height: 90% ; "></output>				
			</div>
		</div>
	</div>

	<!--<input type="file" id="files" name="files[]" />-->

	<div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
		<div class="form-group">
			<button class="btn  btn-primary" type="submit">Guardar</button>
			<button class="btn  btn-danger" type="reset"><a href="{{URL::action('ArticuloController@index')}}" title="Cancelar y volver atrás" style="color: white ; ">Cancelar</a></button>
		</div>
	</div>

</div>

{!!Form::close()!!}

@push('scripts')
<script type="text/javascript">

	$('#btn_imprimir_codigo').hide();
	document.getElementById('files').addEventListener('change', archivo, false);

	function recuperarCodigoo(){
		return document.getElementById("codigo").value;
	}

	function generarBarras(){
		var cod=document.getElementById("codigo").value;
		


		document.getElementById("barcode").innerHTML='<img src="codigo"  id="barra">';
		JsBarcode("#barra").EAN13(cod, {fontSize: 18, textMargin: 0}).render();
		$('#btn_imprimir_codigo').show();
	}


	function imprSelec(nombre) {
		var ficha = document.getElementById(nombre);
		var ventimp = window.open(' ', 'popimpr');
		ventimp.document.write( ficha.innerHTML );
		ventimp.document.close();
		ventimp.print( );
		ventimp.close();
	}


	function archivo(evt) {
			var files = evt.target.files; // FileList object

			//Obtenemos la imagen del campo "file".
			for (var i = 0, f; f = files[i]; i++) {
				//Solo admitimos imágenes.
				if (!f.type.match('image.*')) {
					continue;
				}

				var reader = new FileReader();

				reader.onload = (function(theFile) {
					return function(e) {
						// Creamos la imagen.
						document.getElementById("list").innerHTML = ['<img style="height: 100%; width:100%" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
					};
				})(f);
				reader.readAsDataURL(f);
			}
		}

	</script>
	@endpush

	@endsection
