<?php

namespace Sistema\Http\Controllers;

use Illuminate\Http\Request;
use Sistema\Persona;
use Illuminate\Support\Facades\Redirect;
use Sistema\Http\Requests\PersonaFormRequest;
use DB;
use PDF;
use Excel;

class ProveedorController extends Controller
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
			->where('tipo_persona','=','Proveedor')
			->orwhere('num_documento','LIKE','%'.$query.'%')
			->where('tipo_persona','=','Proveedor')

			->orderBy('idpersona','desc')
			->paginate(7);
			return view('compras.proveedor.index',["personas"=>$personas,"searchText"=>$query]);
		}
	}
	public function create()
	{
		return view("compras.proveedor.create");
	}
	public function store(PersonaFormRequest $request)
	{
		$persona=new Persona;
		$persona->tipo_persona='Proveedor';
		$persona->nombre=$request->get('nombre');
		$persona->tipo_documento=$request->get('tipo_documento');
		$persona->num_documento=$request->get('num_documento');
		$persona->direccion=$request->get('direccion');
		$persona->telefono=$request->get('telefono');
		$persona->email=$request->get('email');
		$persona->save();
		return Redirect::to('compras/proveedor');

	}
	public function show($id)
	{
		return view("compras.proveedor.show",["persona"=>Persona::findOrFail($id)]);
	}
	public function edit($id)
	{
		return view("compras.proveedor.edit",["persona"=>Persona::findOrFail($id)]);
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
		return Redirect::to('compras/proveedor');
	}
	public function destroy($id)
	{
		$persona=Persona::findOrFail($id);
		$persona->tipo_persona='ProveedorInactivo';
		$persona->update();
		return Redirect::to('compras/proveedor');
	}

	public function reportExcelProveedores()
	{
		Excel::create('proveedores', function($excel){
			$excel->sheet('proveedores ventana', function($sheet){
				$sheet->loadView('compras.proveedor.report',['proveedores'=> DB::table('persona')
					->where('tipo_persona','=','Proveedor')
					->orderBy('idpersona','asc')
					->get(),'contador'=>1]);
			}
			);
		}
		)->export('xls');
	}

	public function reportPdfProveedores()
	{
		$proveedores=DB::table('persona')
		->where('tipo_persona','=','Proveedor')
		->orderBy('idpersona','asc')
		->get();

		$pdf=PDF::loadView('compras.proveedor.report',['proveedores'=>$proveedores,'contador'=>1]);

		return $pdf->stream('proveedores.pdf');
	}

	public function reportWordProveedores()
	{
		$proveedores=DB::table('persona')
		->where('tipo_persona','=','Proveedor')
		->orderBy('idpersona','asc')
		->get();

		$pdf=PDF::loadView('compras.proveedor.report',['proveedores'=>$proveedores,'contador'=>1]);

		return $pdf->download('proveedores.docx');
	}
}
