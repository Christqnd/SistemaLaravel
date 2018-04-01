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

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Año</th>
                <th>Enero</th>
                <th>Febrero</th>
                <th>Marzo</th>
                <th>Abril</th>
                <th>Mayo</th>
                <th>Junio</th>
                <th>Julio</th>
                <th>Agosto</th>
                <th>Septiembre</th>
                <th>Octubre</th>
                <th>Noviembre</th>
                <th>Diciembre</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($tabla as $t)
           <tr>
               <td>{{$t->anho}}</td>
               <td>{{$t->Enero}}</td>
               <td>{{$t->Febrero}}</td>
               <td>{{$t->Marzo}}</td>
               <td>{{$t->Abril}}</td>
               <td>{{$t->Mayo}}</td>
               <td>{{$t->Junio}}</td>
               <td>{{$t->Julio}}</td>
               <td>{{$t->Agosto}}</td>
               <td>{{$t->Septiembre}}</td>
               <td>{{$t->Octubre}}</td>
               <td>{{$t->Noviembre}}</td>
               <td>{{$t->Diciembre}}</td>
           </tr>
           
           @endforeach
       </tbody>
   </table>
</div>



@endsection

