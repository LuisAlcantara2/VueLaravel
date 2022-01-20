<template>
  <div class="row">
    <div>
      <router-link to="/crearVenta" class="btn btn-success" custom v-slot="{ navigate }">
        <span @click="navigate" @keypress.enter="navigate" role="link"> <i class="fas fa-plus-circle"></i>  Nuevo</span>
      </router-link>
    </div>
    <div class="col-12 mt-3"> 
      <div class="table-responsive">
        <table class="table table-border">
          <thead class="bg-primary text-white">
            <tr>
              <th>#</th>
              <th>Fecha</th>
              <th>Documento</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="venta in ventas" :key="venta.id">
              <td>{{ venta.id }}</td>              
              <td>{{ venta.ven_fecha | formatDate}}</td>
              <!-- format("YYYY-MM-DD"), -->
              <td>{{ venta.ven_serie}} - {{ venta.ven_correlativo}}</td>
              <td>
                <router-link :to="{name:'editarVenta', params: { id: venta.id }}" class="btn btn-info" custom v-slot="{ navigate }">
                  <span @click="navigate" @keypress.enter="navigate" role="link"><i class="fas fa-edit"></i> Editar</span>
                </router-link>
                <a type="button" @click="borrarVenta(venta.id)" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar </a>
              </td>
            </tr>
          </tbody>
        </table>
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
  name:"ventas",
  data(){
    return{
      ventas:[]
    }
  },
  mounted(){
    this.mostrarVentas()
  },
  methods: {
    async mostrarVentas(){
      await this.axios.get('api/venta')
        .then(response=>{
          this.ventas = response.data
        })
        .catch(error=>{
          this.ventas = []
        })
    },
    borrarVenta(id){
      Swal.fire({
        title:'¿Confirma eliminar el registro?',
        confirmButtonText:'Confirmar',
        showCancelButton: true
      }).then((result)=>{
        if(result.isConfirmed){
          this.axios.delete(`/api/venta/${id}`).then(response=>{this.mostrarVentas()}).catch(error=>{console.log(error)});
          Swal.fire('Eliminado','','success')
        }else if(result.isDenied){}
      });
      // if (confirm("¿Confirma eliminar el registro?")){
      //   this.axios.delete(`/api/venta/${id}`)
      //   .then(response=>{
      //     this.mostrarVentas()
      //   })
      //   .catch(error=>{
      //     console.log(error)
      //   })
      // }
    },
  },
}
</script>