<template>
<div class="container">
  <div class="row justify-content">
    <div class="col-3 mb-2">
      <label for="">Desde:</label>
      <input class="form-control" type="date" name="desde" id="desde" v-model="desde" :max="this.hasta">
    </div>
    <div class="col-3 mb-2">
      <label for="">Hasta:</label>
      <input class="form-control" type="date" name="desde" id="desde" v-model="hasta" :min="this.desde"> 
    </div>
    <div class="col-3 mt-4">
      <button class="btn btn-primary" @click="Actualizar"><i class="fas fa-search"></i> Filtrar</button>
    </div>
    <div class="col-3 mt-4 end">
      <button class="btn btn-danger" @click="Reporte"><i class="fas fa-file"></i> PDF</button>
    </div>
  </div>
  <div class="row justify-content-between">
    <div class="col-12 mt-3">
      <div class="table-responsive">
        <table class="table table-border">
          <thead class="bg-primary text-white">
            <tr>
              <th>#</th>
              <th>Fecha</th>
              <th>Compra</th>
              <th>Proveedor</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(compra,index) in compras" :key="compra.id">
              <td>{{ index+1}}</td>
              <td>{{ compra.com_fecha | formatDate}}</td>
              <td>{{ compra.com_serie}} - {{ compra.com_correlativo}}</td>
              <td>{{ compra.pvd_nombre}}</td>
              <td align="right">{{ compra.com_total}}</td>
            </tr>
            <tr>
              <td></td>
              <td><strong>TOTAL</strong></td>
              <td></td>
              <td></td>
              <td align="right"><strong>{{(this.total).toFixed(2)}}</strong></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import moment from "moment";
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('MM/DD/YYYY')
  }
})
export default{
  name : "crear-venta",
  components: {
  },
  data(){
    return {
      desde:moment().add(-1,'M').format("YYYY-MM-DD"),
      hasta:moment().format("YYYY-MM-DD"),
      compras:[],
      total:0,
    }
  },

   mounted(){    
    this.getrptCompras()
  },
  methods:{
    Actualizar(){
      if(this.desde==""){
        Swal.fire('Ingrese fecha inicial','','error')
      }
      else if (this.hasta==""){
        Swal.fire('Ingrese fecha final','','error')
      }
      else{
        this.getrptCompras()
      }
    },
    async Reporte(file){
      if(this.desde==""){
        Swal.fire('Ingrese fecha inicial','','error')
      }
      else if (this.hasta==""){
        Swal.fire('Ingrese fecha final','','error')
      }
      else{
        axios({
        url: '/api/reporteCompraPdf',
        method: 'GET',
        responseType: 'blob', // important
        params:{
          desde:this.desde,
          hasta:this.hasta,
        },
      }).then((response) => {
        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement('a');
        link.href = url;
        link.setAttribute('download', 'file.pdf');
        document.body.appendChild(link);
        // link.click();
      });
      window.open("pdf/reporte Compra.pdf");
      }
    },
    async getrptCompras(){
      await this.axios.get('/api/getrptCompras',{
        params:{
          desde:this.desde,
          hasta:this.hasta,
        }
        }).then(response=>{
          this.compras = response.data.compra
          this.sumPrecios()
        })
        .catch(error=>{
          this.compras = 0.00
        })
    },
    sumPrecios() {
      this.total=0
      this.compras.forEach(element => {
        this.total+=Number(element.com_total)
      });
    },
  }
}
</script>