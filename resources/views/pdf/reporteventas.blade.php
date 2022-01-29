<div style="width: 100%; text-align:center">
  <h2>REPORTE DE VENTAS DEL {{$desde}} AL {{$hasta}}</h2>
</div>
<table style="width: 100%;font-size:11px;margin-top:5px;border-collapse:collapse">
  <tr>
      <td style="text-align: center">FECHA</td>
  </tr>

@foreach ($venta as $item)
        <tr>
            <td> 
                aa{{$item->ven_fecha}}
            </td>
        </tr>
    @endforeach
</table>