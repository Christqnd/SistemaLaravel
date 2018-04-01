<?php

namespace Sistema\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Sistema\Http\Requests\IngresoFormRequest;
use Sistema\Http\Requests\PersonaFormRequest;
use Sistema\Ingreso;
use Sistema\DetalleIngreso;
use Sistema\Persona;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $numClientes=DB::table('persona as p')
        ->where('p.tipo_persona','=','Cliente')
        ->select(DB::raw('count(p.tipo_persona) as num'))
        ->groupBy('p.tipo_persona')
        ->get();

        $numProveedores=DB::table('persona as p')
        ->where('p.tipo_persona','=','Proveedor')
        ->select(DB::raw('count(p.tipo_persona) as num'))
        ->groupBy('p.tipo_persona')
        ->get();

        $numCategorias=DB::table('categoria as c')
        ->where('c.condicion','=','1')
        ->select(DB::raw('count(c.condicion) as num'))
        ->groupBy('c.condicion')
        ->get();

        $numArticulos=DB::table('articulo as a')
        ->where('a.estado','=','Activo')
        ->select(DB::raw('count(a.estado) as num'))
        ->groupBy('a.estado')
        ->get();

        $numIngresos=DB::table('ingreso as a')
        ->where('a.estado','=','A')
        ->select(DB::raw('count(a.estado) as num'))
        ->groupBy('a.estado')
        ->get();

        $numVentas=DB::table('venta as v')
        ->where('v.estado','=','A')
        ->select(DB::raw('count(v.estado) as num'))
        ->groupBy('v.estado')
        ->get();


        return view('graficos.resumen',["numClientes"=>$numClientes 
            ,"numProveedores"=>$numProveedores
            ,"numArticulos"=>$numArticulos
            ,"numCategorias"=>$numCategorias
            ,"numIngresos"=>$numIngresos
            ,"numVentas"=>$numVentas]);
    }


    public function resumen(){
        $tablaReporte=DB::table('tabla_reporte as tr')
        ->where('tr.anho','=','2017')
        ->get();

        return view('graficos.graficos',["tablaReporte"=>$tablaReporte]);
    }

    public function tabla(){
        $tabla=DB::select('select * from tabla_reporte' );
        

        return view('graficos.tablas',["tabla"=>$tabla]);
    }
}
