@extends('layouts.admin')
@section('contenido')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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



<!-- Centered Pills -->
<ul class="nav nav-pills nav-justified nav-tabs ">
  <li class="list-group-item"><a href="{{url('graficos/resumen')}}">Resumen</a></li>
  <li class="list-group-item"><a href="{{url('graficos/graficos')}}">Graficas</a></li>
  <li class="list-group-item"><a href="{{url('graficos/tablas')}}">Tablas</a></li>
</ul>


<!--Contenido grafico-->
<div class="row tab-content">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>

          <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <!--Contenido-->
            @yield('resumen')
            <!--Fin Contenido-->
          </div>
        </div>

      </div>
    </div><!-- /.row -->
  </div><!-- /.box-body -->
</div><!-- /.box -->  



@endsection

