<?php

namespace Sistema\Http\Controllers;

use Illuminate\Http\Request;
use Sistema\Http\Requests;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Sistema\Http\Requests\ArticuloFormRequest;
use Sistema\Articulo;
use DB;
use PDF;
use Excel;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;


class ArticuloController extends Controller
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
			$articulos=DB::table('articulo as a')
			->join('categoria as c','a.idcategoria','=','c.idcategoria')
			->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
			->where('a.nombre','LIKE','%'.$query.'%')
			->orwhere('a.codigo','LIKE','%'.$query.'%')
			->orderBy('a.idarticulo','desc')
			->paginate(7);
			return view('almacen.articulo.index',["articulos"=>$articulos ,"searchText"=>$query]);
		}
	}
	public function create()
	{
		$categorias=DB::table('categoria')
		->where('condicion','=','1')
		->get();

		return view("almacen.articulo.create",['categorias'=>$categorias]);
	}
	public function store(ArticuloFormRequest $request)
	{
		$articulo=new Articulo;
		$articulo->idcategoria=$request->get('idcategoria');
		$articulo->codigo=$request->get('codigo');
		$articulo->nombre=$request->get('nombre');
		$articulo->stock=$request->get('stock');
		$articulo->descripcion=$request->get('descripcion');
		$articulo->estado='Activo';
		if (Input::hasFile('imagen')) {
			$file=Input::file('imagen');
			$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
			$articulo->imagen=$file->getClientOriginalName();
		}
		$articulo->save();
		return Redirect::to('almacen/articulo');

	}
	public function show($id)
	{
		return view("almacen.articulo.show",["articulo"=>Articulo::findOrFail($id)]);
	}
	public function edit($id)
	{
		$articulo=Articulo::findOrFail($id);
		$categorias=DB::table('categoria')
		->where('condicion','=','1')
		->get();
		return view("almacen.articulo.edit",["articulo"=>$articulo,"categorias"=>$categorias]);
		}
	public function update(ArticuloFormRequest $request,$id)
	{
		$articulo=Articulo::findOrFail($id);
		$articulo->idcategoria=$request->get('idcategoria');
		$articulo->codigo=$request->get('codigo');
		$articulo->nombre=$request->get('nombre');
		$articulo->stock=$request->get('stock');
		$articulo->descripcion=$request->get('descripcion');
		$articulo->estado='Activo';
		if (Input::hasFile('imagen')) {
			$file=Input::file('imagen');
			$file->move(public_path().'/imagenes/articulos/',$file->getClientOriginalName());
			$articulo->imagen=$file->getClientOriginalName();
		}
		$articulo->update();
		return Redirect::to('almacen/articulo');
	}

	public function destroy($id)
	{
		$articulo=Articulo::findOrFail($id);
		$articulo->estado='Inactivo';
		$articulo->update();
		return Redirect::to('almacen/articulo');
	}

	public function generarCodigo($codigo)
	{
		$categorias=DB::table('categoria')
		->where('condicion','=','1')
		->get();

		return view('almacen.articulo.grafico',["codigo"=>$codigo,"categorias"=>$categorias	]);
	}

	public function reportExcelArticulos()
	{
		Excel::create('articulos', function($excel){
			$excel->sheet('articulos ventana', function($sheet){
				$sheet->loadView('almacen.articulo.report',['articulos'=> DB::table('articulo as a')
					->join('categoria as c','a.idcategoria','=','c.idcategoria')
					->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
					->orderBy('a.idarticulo','asc')
					->get(),'contador'=>1]);
			}
			);
		}
		)->export('xls');
	}

	public function reportPdfArticulos(){
		$articulos=DB::table('articulo as a')
		->join('categoria as c','a.idcategoria','=','c.idcategoria')
		->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
		->orderBy('a.idarticulo','asc')
		->get();

		$pdf=PDF::loadView('almacen.articulo.report',['articulos'=>$articulos,'contador'=>1]);

		return $pdf->stream('articulo.pdf');
	}

	public function reportWordArticulos(){
		$articulos=DB::table('articulo as a')
		->join('categoria as c','a.idcategoria','=','c.idcategoria')
		->select('a.idarticulo','a.nombre','a.codigo','a.stock','c.nombre as categoria','a.descripcion','a.imagen','a.estado')
		->orderBy('a.idarticulo','asc')
		->get();

		$pdf=PDF::loadView('almacen.articulo.report',['articulos'=>$articulos,'contador'=>1]);

		return $pdf->download('articulo.docx');
	}
}
