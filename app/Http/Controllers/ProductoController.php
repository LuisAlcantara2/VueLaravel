<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use DB;
class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filtro = $request->nombre;
        // $productos = Producto::all();
        $productos = Producto::select('productos.*',DB::raw("concat(concat(pro_nombre,' '),marcas.mar_nombre) as nombre"),'marcas.mar_nombre')
        ->join('marcas','marcas.id','=','productos.marca_id')
        ->where('pro_nombre','LIKE','%'.$filtro.'%')
        ->orderBy('pro_stockactual','asc')->get();
        return response()->json($productos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $producto = Producto::create($request->post());
        return response()->json([
            'producto'=>$producto
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        $producto = Producto::select('productos.*',DB::raw("concat(concat(pro_nombre,' '),marcas.mar_nombre) as nombre"),'marcas.mar_nombre')
        ->join('marcas','marcas.id','=','productos.marca_id')
        ->where('productos.id','=',$producto->id)->first();
        return response()->json($producto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $producto->fill($request->post())->save();
        return response()->json([
            'producto'=>$producto
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->json([
            'mensaje'=>'Producto eliminado'
        ]);
    }

    public function movimiento($id)
    {
        $movimientos = DB::table('kardex')->where('producto_id','=',$id)->get();
        return response()->json($movimientos);
    }
}
