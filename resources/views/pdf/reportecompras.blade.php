<style>
  table, th, td {
    border: 1px solid black;
  }
</style>
<div style="width: 100%; text-align:center">
  <h2>REPORTE DE COMPRAS DEL {{$desde}} AL {{$hasta}}</h2>
</div>
<table style="width: 100%;font-size:14px;margin-top:5px;border-collapse: collapse; border:1px solid" >
  <tr>
      <td style="text-align: center">SERIE</td>
      <td style="text-align: center">FECHA</td>
      <td style="text-align: center">PROVEEDOR</td>
      <td style="text-align: center">TOTAL</td>
  </tr>

@foreach ($compra as $item)
        <tr>
            <td scope="row" style="text-align:center">  
                {{$item->com_serie}}
            </td>
            <td style="text-align:center">
                {{$item->com_fecha}}
            </td>

            <td style="text-align:left">
                {{$item->pvd_nombre}}
            </td>
            <td style="text-align:right">
                {{$item->com_total}}
            </td>
        </tr>
    @endforeach
    <tr>
      <td scope="row" colspan="3"><strong>TOTAL: </strong></td>
      <td style="text-align:right"><strong> {{$total}}</strong></td>
    </tr>
    
</table>