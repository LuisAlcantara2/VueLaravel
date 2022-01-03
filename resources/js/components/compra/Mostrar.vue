<template>
<div class="container">
  <div class="row">
    <div>
      <router-link to="/crearCompra" class="btn btn-success" custom v-slot="{ navigate }">
        <span @click="navigate" @keypress.enter="navigate" role="link"> <i class="fas fa-plus-circle"></i>  Nuevo</span>
      </router-link>
    </div>
    <div class="col-12"> 
      <div class="table-responsive">
        <table class="table table-border">
          <thead class="bg-primary text-white">
            <tr>
              <th>#</th>
              <th>Fecha</th>
              <th>Compra</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="compra in compras" :key="compra.id">
              <td>{{ compra.id}}</td>
              <td>{{ compra.com_fecha | formatDate}}</td>
              <td>{{ compra.com_serie}} - {{ compra.com_correlativo}}</td>
              <td>
                <router-link :to="{name:'editarCompra', params: { id: compra.id }}" class="btn btn-info" custom v-slot="{ navigate }">
                  <span @click="navigate" @keypress.enter="navigate" role="link">Editar</span>
                </router-link>
                <a type="button" @click="borrarCompra(compra.id)" class="btn btn-danger"> Eliminar </a>
              </td>
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
  name:"compras",
  data(){
    return{
      compras:[]
    }
  },
  mounted(){
    this.mostrarCompras()
  },
  methods: {
    async mostrarCompras(){
      await this.axios.get('api/compra')
        .then(response=>{
          this.compras = response.data
        })
        .catch(error=>{
          this.compras = []
        })
    },
    borrarCompra(id){
      Swal.fire({
        title:'¿Confirma eliminar el registro?',
        confirmButtonText:'Confirmar',
        showCancelButton: true
      }).then((result)=>{
        if(result.isConfirmed){
          this.axios.delete(`/api/compra/${id}`).then(response=>{this.mostrarCompras()}).catch(error=>{console.log(error)});
          Swal.fire('Eliminado','','success')
        }else if(result.isDenied){}
      });
      // if (confirm("¿Confirma eliminar el registro?")){
      //   this.axios.delete(`/api/compra/${id}`)
      //   .then(response=>{
      //     this.mostrarCompras()
      //   })
      //   .catch(error=>{
      //     console.log(error)
      //   })
      // }
    },
  },
}
</script>