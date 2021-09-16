<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Entrada;
use App\Models\Producto;
use Exception;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EntradaController extends Controller
{
    public function index(){
        return view('compras.listarCompras');
    }

    public function indexEntradas($id){
        $compra = Compra::findOrFail($id);
        return view('compras.listarEntradas', compact("compra"));
    }

    public function getCompras(){
        if(request()->ajax()){
            $compras = Compra::all();
            return Datatables::of($compras)
                ->addColumn('opciones', function ($compra) {
                    return '<a href="/compras/ver/'.$compra->id.'" class="btn btn-dark">Ver compra</a>';
                })
                ->rawColumns(['opciones'])
                ->make(true);
        }else{
            return redirect('/compras')->withErrors('Url no disponible');
        }
    }

    public function getEntradas($id){
        if(request()->ajax()){
            $compras = Entrada::join('productos', 'productos.id', '=', 'entradas.idProducto')
            ->select('entradas.*', 'productos.nombreProducto')
            ->where('entradas.idCompra', '=', $id)->get();
            return Datatables::of($compras)
                ->editColumn('created_at', function($compra){
                    return $compra->created_at->toDateTimeString();
                })
                ->make(true);
        }else{
            return redirect('/compras')->withErrors('Url no disponible');
        }
    }

    public function create(){
        $productos = Producto::all();
        return view('compras.crearCompras', compact("productos"));
    }

    public function save(Request $request){
        if(count($request->idProducto) < 1 || count($request->cantidad) < 1){
            return redirect('/compras')->withErrors('No se pudo realizar la compra.');
        }
        try {
            DB::beginTransaction();
            $compra = Compra::create([
                'nombreCompra' => $request->nombreCompra
            ]);
            foreach($request->idProducto as $key => $value){
                Entrada::create([
                    'idProducto' => $value,
                    'idCompra' => $compra->id,
                    'cantidadIngresada' => $request->cantidad[$key]
                ]);
                $producto = Producto::findOrFail($value);
                $producto->update([
                    'cantidad' => $request->cantidad[$key]
                ]);
            }
            DB::commit();
            return redirect('/compras')->with('success', 'Se guardo la compra');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/compras')->withErrors('Ocurrio un error inesperado. Vuelva a intentarlo.');
        }
        
    }
}
