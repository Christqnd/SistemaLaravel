@extends('home')
@section('resumen')
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


<div class="row">


  <div class="col-md-4">
    <div class="box box-solid box-info">
      <div class="box-header">
        <h3 class="box-title">Almacén</h3>
      </div><!-- /.box-header -->
      <div class="box-body">

        <div class="info-box bg-aqua">
          <span class="info-box-icon"><i class="fa fa-suitcase"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Categorias</span>
            <span class="info-box-number">{{$numCategorias[0]->num}}</span>
            <div class="progress">
              <div class="progress-bar" style="width: 70%"></div>
            </div>
            <span class="progress-description">
              Categorias registradas 
            </span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

        <div class="info-box bg-yellow">
          <span class="info-box-icon"><i class="fa fa-folder-open" aria-hidden="true"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Artículos</span>
            <span class="info-box-number">{{$numArticulos[0]->num}}</span>
            <div class="progress">
              <div class="progress-bar" style="width: 70%"></div>
            </div>
            <span class="progress-description">
              Artículos registrados
            </span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>


  <div class="col-md-4">
    <div class="box box-solid box-primary">
      <div class="box-header">
        <h3 class="box-title">Compras</h3>
      </div><!-- /.box-header -->
      <div class="box-body">

        <div class="info-box bg-green">
          <span class="info-box-icon"><i class="fa fa-sitemap"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Proveedores</span>
            <span class="info-box-number">{{$numProveedores[0]->num}}</span>
            <div class="progress">
              <div class="progress-bar" style="width: 70%"></div>
            </div>
            <span class="progress-description">
              Proveedores registrados
            </span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->


        <div class="info-box bg-aqua">
          <span class="info-box-icon"><i class="fa fa-truck"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Ingresos</span>
            <span class="info-box-number">{{$numIngresos[0]->num}}</span>
            <div class="progress">
              <div class="progress-bar" style="width: 70%"></div>
            </div>
            <span class="progress-description">
              Ingresos procesados
            </span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>



  <div class="col-md-4">
    <div class="box box-solid box-success">
      <div class="box-header">
        <h3 class="box-title">Ventas</h3>
      </div><!-- /.box-header -->
      <div class="box-body">

        <div class="info-box bg-aqua">
          <span class="info-box-icon"><i class="fa fa-users"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Clientes</span>
            <span class="info-box-number">{{$numClientes[0]->num}}</span>
            <div class="progress">
              <div class="progress-bar" style="width: 70%"></div>
            </div>
            <span class="progress-description">
              Clientes registradas
            </span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Ventas</span>
            <span class="info-box-number">{{$numVentas[0]->num}}</span>
            <div class="progress">
              <div class="progress-bar" style="width: 70%"></div>
            </div>
            <span class="progress-description">
              Ventas realizadas
            </span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->

      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>

</div>



@endsection

