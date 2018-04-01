<?php

namespace Sistema\Http\Controllers;

use Illuminate\Http\Request;
use Sistema\Persona;
use Illuminate\Support\Facades\Redirect;
use Sistema\Http\Requests\PersonaFormRequest;
use DB;
use PDF;
use Excel;

class ClienteController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function index(Request $request)
	{
		if ($request)
		{
			$query=trim($request->get('searchText'));
			$personas=DB::table('persona')
			->where('nombre','LIKE','%'.$query.'%')
			->where('tipo_persona','=','Cliente')
			->orwhere('num_documento','LIKE','%'.$query.'%')
			->where('tipo_persona','=','Cliente')
			->orderBy('idpersona','desc')
			->paginate(7);
			return view('ventas.cliente.index',["personas"=>$personas,"searchText"=>$query]);
		}
	}
	public function create()
	{
		return view("ventas.cliente.create");
	}
	public function store(PersonaFormRequest $request)
	{
		$persona=new Persona;
		$persona->tipo_persona='Cliente';
		$persona->nombre=$request->get('nombre');
		$persona->tipo_documento=$request->get('tipo_documento');
		$persona->num_documento=$request->get('num_documento');
		$persona->direccion=$request->get('direccion');
		$persona->telefono=$request->get('telefono');
		$persona->email=$request->get('email');
		$persona->save();
		return Redirect::to('ventas/cliente');

	}
	public function show($id)
	{
		return view("ventas.cliente.show",["persona"=>Persona::findOrFail($id)]);
	}
	public function edit($id)
	{
		return view("ventas.cliente.edit",["persona"=>Persona::findOrFail($id)]);
	}
	public function update(PersonaFormRequest $request,$id)
	{
		$persona=Persona::findOrFail($id);
		$persona->nombre=$request->get('nombre');
		$persona->tipo_documento=$request->get('tipo_documento');
		$persona->num_documento=$request->get('num_documento');
		$persona->direccion=$request->get('direccion');
		$persona->telefono=$request->get('telefono');
		$persona->email=$request->get('email');
		$persona->update();
		return Redirect::to('ventas/cliente');
	}
	public function destroy($id)
	{
		$persona=Persona::findOrFail($id);
		$persona->tipo_persona='ClienteInactivo';
		$persona->update();
		return Redirect::to('ventas/cliente');
	}

	public function reportExcelClientes(){
		Excel::create('clientes', function($excel){
			$excel->sheet('clientes ventana', function($sheet){
				$sheet->loadView('ventas.cliente.report',['clientes'=> DB::table('persona as p')->where('p.tipo_persona','=','Cliente')->get(),'contador'=>1]);
			}
			);
		}
		)->export('xls');
	}

	public function reportPdfClientes(){
		$clientes=DB::table('persona as p')
		->where('p.tipo_persona','=','Cliente')
		->get();

		$pdf=PDF::loadView('ventas.cliente.report',['clientes'=>$clientes,'contador'=>1]);

		return $pdf->stream('clientes.pdf');
	}

	public function reportWordClientes(){
		$clientes=DB::table('persona as p')
		->where('p.tipo_persona','=','Cliente')
		->get();

		$pdf=PDF::loadView('ventas.cliente.report',['clientes'=>$clientes,'contador'=>1]);

		return $pdf->download('clientes.docx');
	}
}
