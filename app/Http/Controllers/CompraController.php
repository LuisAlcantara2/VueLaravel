<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use App\Models\Kardex;
use Carbon\Carbon;
use DB;
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
        $request->all();
        $compra = Compra::create($request->post());
        foreach($request->detalle as $item){
            $this->guardarVentaDetalle($item,$compra->id);
        }
        return response()->json([
            'compra'=>$compra
        ]);
    }
    protected function guardarVentaDetalle($item, $id){
        //dd($item);
        // $det = new DetalleCompra(
        //     $item['Precio'],
        //     $item['Cantidad'],
        //     $id,
        //     1
        // );
        // $deta = DetalleCompra::create($det->post());
        $detalle = DetalleCompra::create([
            'dcp_cantidad' => $item['Cantidad'],
            'dcp_precio' => $item['Precio'],
            'compra_id' => $id,
            'producto_id' => $item['id'],
        ]);
        $fechaact = Carbon::now();
        $kardex = Kardex::create([
            'krd_fecha' => $fechaact,
            'krd_tipo' => 1,
            'krd_cantidad' => $item['Cantidad'],
            'producto_id' => $item['id'],
        ]);

        Producto::ActualizarStock($detalle->producto_id,$detalle->dcp_cantidad);
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
            'mensaje'=>'Compra eliminada'
        ]);
    }
    public function getCompras(Request $request)
    {
        $compras = DB::table('compras')->whereYear('com_fecha',$request->año)->whereMonth('com_fecha',$request->mes)->count();
        return response()->json([
            'compra'=>$compras
        ]);
    }
    public function getrptCompras(Request $request)
    {
        $compras = Compra::whereBetween('com_fecha', [$request->desde, $request->hasta])
        ->join('proveedores', 'proveedores.id', '=', 'compras.proveedor_id')->get();

        return response()->json([
            'compra'=>$compras
        ]);
    }
}
