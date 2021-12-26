<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Compra;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compras = Compra::all();
        return response()->json($compras);
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

        $compra = Compra::create($request->post());
        foreach($request->detalle as $item){
            $this->guardarVentaDetalle($item,$compra->id);
        }
        return response()->json([
            'compra'=>$compra
        ]);
    }
    protected function guardarVentaDetalle($producto, $id){
        $detalle = DtalleCompra::create([
            'precio'=> $producto->precio,
            'cantidad' => $producto->cantidad,
            'compra_id' => $codventa,
            'producto_od' => $producto->codproducto
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        return response()->json($compra);
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
    public function update(Request $request, Compra $compra)
    {
        $compra->fill($request->post())->save();
        return response()->json([
            'compra'=>$compra
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        $compra->delete();
        return response()->json([
            'mensaje'=>'Compra eliminado'
        ]);
    }
}
