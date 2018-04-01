<?php

namespace Sistema\Http\Controllers;

use Illuminate\Http\Request;

use Sistema\Http\Requests;
use Sistema\Categoria;
use Illuminate\Support\Facades\Redirect;
use Sistema\Http\Requests\CategoriaFormRequest;
use DB;
use PDF;
use Excel;

class CategoriaController extends Controller
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
            $categorias=DB::table('categoria')->where('nombre','LIKE','%'.$query.'%')
            ->where ('condicion','=','1')
            ->orderBy('idcategoria','desc')
            ->paginate(7);
            return view('almacen.categoria.index',["categorias"=>$categorias,"searchText"=>$query]);
        }
    }
    public function create()
    {
        return view("almacen.categoria.create");
    }
    public function store(CategoriaFormRequest $request)
    {
        $categoria=new Categoria;
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->condicion='1';
        $categoria->save();
        return Redirect::to('almacen/categoria');

    }
    public function show($id)
    {
        return view("almacen.categoria.show",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("almacen.categoria.edit",["categoria"=>Categoria::findOrFail($id)]);
    }
    public function update(CategoriaFormRequest $request,$id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->nombre=$request->get('nombre');
        $categoria->descripcion=$request->get('descripcion');
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }
    public function destroy($id)
    {
        $categoria=Categoria::findOrFail($id);
        $categoria->condicion='0';
        $categoria->update();
        return Redirect::to('almacen/categoria');
    }


    public function reportExcelCategorias()
    {
        Excel::create('categorias', function($excel){
            $excel->sheet('categorias ventana', function($sheet){
                $sheet->loadView('almacen.categoria.report',['categorias'=> DB::table('categoria')->where ('condicion','=','1')->orderBy('idcategoria','asc')->get() ,'contador'=>1]);
            }
            );
        }
        )->export('xls');
    }

    public function reportPdfCategorias(){

        $categorias=DB::table('categoria')
        ->where ('condicion','=','1')
        ->orderBy('idcategoria','asc')
        ->get();

        $pdf=PDF::loadView('almacen.categoria.report',['categorias'=>$categorias,'contador'=>1]);

        return $pdf->stream('categorias.pdf');
    }

    public function reportWordCategorias(){
        $categorias=DB::table('categoria')
        ->where ('condicion','=','1')
        ->orderBy('idcategoria','asc')
        ->get();

        $pdf=PDF::loadView('almacen.categoria.report',['categorias'=>$categorias,'contador'=>1]);

        return $pdf->download('categorias.docx');
    }
}
