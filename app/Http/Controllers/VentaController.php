<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Kardex;
use App\Models\Serie;
use App\Models\Compra;
Use \Carbon\Carbon;
use DB;
use PDF;
class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::orderBy('ven_fecha','desc')->get();
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
        DB::beginTransaction();
        try {
            $ser_id = DB::table('serie')->where('ser_serie','=',$request->ven_serie)->first();
            $serie = Serie::find($ser_id->id);
            $serie->ser_corre = $request->ven_correlativo+1;
            $serie->save();
            $ser_det = $request->ven_serie."-".$request->ven_correlativo;
            $request->all();
            $venta = Venta::create($request->post());
            foreach($request->detalle as $item){
                $this->guardarVentaDetalle($item,$venta->id,$ser_det);
            }
            DB::commit();
            return response()->json([
                'venta'=>$venta
            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function guardarVentaDetalle($item, $id,$ser_det){
        $detalle = DetalleVenta::create([
            'dvt_cantidad' => $item['Cantidad'],
            'dvt_precio' => $item['Precio'],
            'venta_id' => $id,
            'producto_id' => $item['id'],
            'stock' => $item['stock'],
        ]);
        $fechaact = Carbon::now();
        $kardex = Kardex::create([
            'krd_fecha' => $fechaact,
            'krd_tipo' => 0,
            'krd_serie' => $ser_det,
            'krd_cantidad' => -$item['Cantidad'],
            'krd_stockant' => $item['stock'],
            'producto_id' => $item['id'],
        ]);

        Producto::ActualizarStock($detalle->producto_id,-($detalle->dvt_cantidad));
    }
    public function show(Venta $venta)
    {
        $detalle = DetalleVenta::select('productos.id as id','productos.pro_nombre as Producto','detalleventas.dvt_precio as Precio','detalleventas.dvt_cantidad as Cantidad',DB::raw('detalleventas.dvt_cantidad * detalleventas.dvt_precio as Subtotal'))
        ->join('productos', 'productos.id', '=', 'detalleventas.producto_id')
        ->where('detalleventas.venta_id','=',$venta->id)->get();
        return response()->json([
            'venta'=>$venta,
            'detalle'=>$detalle,
        ]);

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
    public function getVentas(Request $request)
    { 
        $ventas = DB::table('ventas')->whereYear('ven_fecha',$request->año)->whereMonth('ven_fecha',$request->mes)->count();
        return response()->json([
            'venta'=>$ventas
        ]);
    }
    public function getSaldo(Request $request)
    {
        $saldo = DB::table('ventas')->whereYear('ven_fecha',$request->año)->whereMonth('ven_fecha',$request->mes)->sum("ven_total");
        return response()->json([
            'saldo'=>$saldo
        ]);
    }
    public function getAños()
    {
        $years = Venta::select(DB::raw('YEAR(ven_fecha) as year'))->distinct();
        $b = Compra::select(DB::raw('YEAR(com_fecha) as year'))->distinct()
        ->union($years)
        ->get();
        // $anios = $years->pluck('year');
        return response()->json([
            'anios'=>$b
        ]);
    }
    public function getrptVentas(Request $request)
    {
        $ventas = Venta::whereBetween('ven_fecha', [$request->desde, $request->hasta])
        ->join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
        ->select('ventas.*', 'clientes.cli_nombre')->get();

        return response()->json([
            'venta'=>$ventas
        ]);
    }
    public function reporteVentaPdf(Request $request)
    {
        $total=Venta::whereBetween('ven_fecha', [$request->desde, $request->hasta])->sum('ven_total');
        $ventas = Venta::whereBetween('ven_fecha', [$request->desde, $request->hasta])
        ->join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
        ->select('ventas.*', 'clientes.cli_nombre')->get();

        
        $data = [
            'desde' => $request->desde,
            'hasta' => $request->hasta,
            'venta' => $ventas,
            'total' => $total,
        ];

        $path = public_path() . '/pdf/' . 'reporte Venta' . '.pdf';

        $pdf = PDF::loadView('pdf/reporteventas', $data);

        $pdf->save($path);

        return response()->download($path);
    }

    public function reporteVenta(Request $request){
        $war = DB::select(DB::raw("SET lc_time_names = 'es_Es';"));
        $ventas = DB::table('ventas')
                 ->select(DB::raw("concat(concat(monthname(ven_fecha),'-'),YEAR(ven_fecha)) name"), DB::raw('count(*)  data'))
                 ->groupBy('name')
                 ->orderBy('ven_fecha')
                 ->get();
        // $ventas = Venta::whereBetween('ven_fecha', [$request->desde, $request->hasta])->get();

        return response()->json([
            'venta'=>$ventas
        ]);
    }
    public function reporteVenta2(Request $request){
        $productos = DB::table('ventas')
                ->join('detalleventas', 'detalleventas.venta_id', '=', 'ventas.id')
                ->join('productos', 'productos.id', '=', 'detalleventas.producto_id')
                ->select(DB::raw("sum(detalleventas.dvt_cantidad) as cantidad"),'productos.pro_nombre as nombre')
                ->whereYear('ven_fecha',$request->año)->whereMonth('ven_fecha',$request->mes)
                ->groupBy('productos.pro_nombre')
                ->orderBy('cantidad')
                ->get();
        return response()->json([
            'productos'=>$productos
        ]);
    }
}
