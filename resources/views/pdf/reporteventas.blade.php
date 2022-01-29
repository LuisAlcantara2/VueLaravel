<div style="width: 100%; text-align:center">
  <h2>REPORTE DE VENTAS DEL {{$desde}} AL {{$hasta}}</h2>
</div>
<table style="width: 100%;font-size:11px;margin-top:5px;">
  <tr>
      <td style="text-align: center">SERIE</td>
      <td style="text-align: center">FECHA</td>
      <td style="text-align: center">NOMBRE CLIENTE</td>
      <td style="text-align: center">TOTAL</td>
  </tr>

@foreach ($venta as $item)
        <tr>
            <td scope="row">  
                {{$item->ven_serie}}
            </td>
            <td>
                {{$item->ven_serie}}
            </td>

            <td>
                {{$item->cli_nombre}}
            </td>
            <td>
                {{$item->ven_total}}
            </td>
        </tr>
    @endforeach
    <tr>
      <td scope="row" colspan="3">TOTAL:</td>
      <td>{{$total}}</td>
    </tr>
    
</table>