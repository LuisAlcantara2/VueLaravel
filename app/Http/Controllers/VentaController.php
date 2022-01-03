<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Venta;
use App\Models\DetalleVenta;


class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::all();
        return response()->json($ventas);
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
        $request->all();
        $venta = Venta::create($request->post());
        foreach($request->detalle as $item){
            $this->guardarVentaDetalle($item,$venta->id);
        }
        return response()->json([
            'venta'=>$venta
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function guardarVentaDetalle($item, $id){
        //dd($item);
        // $det = new DetalleVenta(
        //     $item['Precio'],
        //     $item['Cantidad'],
        //     $id,
        //     1
        // );
        // $deta = DetalleVenta::create($det->post());
        $detalle = DetalleVenta::create([
            'dvt_cantidad' => $item['Cantidad'],
            'dvt_precio' => $item['Precio'],
            'venta_id' => $id,
            'producto_id' => $item['id'],
        ]);
    }
    public function show(Venta $venta)
    {
        return response()->json($venta);
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
    public function update(Request $request, Venta $venta)
    {
        $venta->fill($request->post())->save();
        return response()->json([
            'venta'=>$venta
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        $venta->delete();
        return response()->json([
            'mensaje'=>'Venta eliminada'
        ]);
    }
}
