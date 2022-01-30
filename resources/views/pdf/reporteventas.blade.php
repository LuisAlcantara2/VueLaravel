<style>
  table, th, td {
    border: 1px solid black;
  }
</style>
<div style="width: 100%; text-align:center">
  <h2>REPORTE DE VENTAS DEL {{$desde}} AL {{$hasta}}</h2>
</div>
<table style="width: 100%;font-size:14px;margin-top:5px;border-collapse: collapse; border:1px solid" >
  <tr>
      <td style="text-align: center">SERIE</td>
      <td style="text-align: center">FECHA</td>
      <td style="text-align: center">NOMBRE CLIENTE</td>
      <td style="text-align: center">TOTAL</td>
  </tr>

@foreach ($venta as $item)
        <tr>
            <td scope="row" style="text-align:center">  
                {{$item->ven_serie}}
            </td>
            <td style="text-align:center">
                {{$item->ven_fecha}}
            </td>

            <td style="text-align:left">
                {{$item->cli_nombre}}
            </td>
            <td style="text-align:right">
                {{$item->ven_total}}
            </td>
        </tr>
    @endforeach
    <tr>
      <td scope="row" colspan="3"><strong>TOTAL: </strong></td>
      <td style="text-align:right"><strong> {{$total}}</strong></td>
    </tr>
    
</table>