@extends('layouts.admin')
@section('contenido')
<div class="row" >
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" >
		<h3>Nuevo Usuario</h3>
		@if (count($errors)>0)
		<div class="alert alert-danger">
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
				@endforeach
			</ul>
		</div>
		@endif

		{!!Form::open(array('url'=>'seguridad/usuario','method'=>'POST','autocomplete'=>'off'))!!}
		{{Form::token()}}
		
		<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			<label for="name" class="col-md-4 control-label">Nombre</label>
			<input id="name" type="text" class="form-control " name="name" value="{{ old('name') }}" required autofocus placeholder="Nombre del nuevo usuario">

			@if ($errors->has('name'))
			<span class="help-block">
				<strong>{{ $errors->first('name') }}</strong>
			</span>
			@endif
			
		</div>

		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			<label for="email" class="col-md-4 control-label">Dirección de E-Mail</label>
			<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Dirección de correo electrónico del nuevo usuario">

			@if ($errors->has('email'))
			<span class="help-block">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
			@endif
			
		</div>

		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			<label for="password" class="col-md-4 control-label">Contraseña</label>
			<input id="password" type="password" class="form-control" name="password" required placeholder="***....">

			@if ($errors->has('password'))
			<span class="help-block">
				<strong>{{ $errors->first('password') }}</strong>
			</span>
			@endif

		</div>

		<div class="form-group">
			<label for="password-confirm" class="col-md-4 control-label ">Confirmar Contraseña</label>			
			<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="***....">
		</div>

		
		<div class="form-group" style="text-align: center;">
			<button class="btn  btn-primary" type="submit">Guardar</button>
			<button class="btn  btn-danger" type="reset"><a href="{{URL::action('UsuarioController@index')}}" title="Cancelar y volver atrás" style="color: white ; " >Cancelar</a></button>
		</div>

		{!!Form::close()!!}
	</div>
</div>
@endsection