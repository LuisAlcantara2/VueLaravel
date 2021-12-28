<template>
<div class="container">
  <div class="row">
    <div class="mt-2 mb-2">
      <router-link to="/crearUnidad" class="btn btn-success" custom v-slot="{ navigate }">
        <span @click="navigate" @keypress.enter="navigate" role="link"> <i class="fas fa-plus-circle"></i>  Nuevo</span>
      </router-link>
    </div>
    <div class="col-12"> 
      <div class="table-responsive">
        <table class="table table-border">
          <thead class="bg-primary text-white">
            <tr>
              <th>#</th>
              <th>Unidad</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="unidad in unidades" :key="unidad.id">
              <td>{{ unidad.id}}</td>
              <td>{{ unidad.uni_nombre}}</td>
              <td>
                <router-link :to="{name:'editarUnidad', params:{id: unidad.id}}" class="btn btn-info" custom v-slot="{ navigate }">
                  <span @click="navigate" @keypress.enter="navigate" role="link">Editar</span>
                </router-link>
                <a type="button" @click="borrarUnidad(unidad.id)" class="btn btn-danger"> Eliminar </a>
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
export default{
  name:"unidades",
  data(){
    return{
      unidades:[]
    }
  },
  mounted(){
    this.mostrarUnidads()
  },
  methods: {
    async mostrarUnidads(){
      await this.axios.get('api/unidad')
        .then(response=>{
          this.unidades = response.data
        })
        .catch(error=>{
          this.unidades = []
        })
    },
    borrarUnidad(id){
      Swal.fire({
        title:'¿Confirma eliminar el registro?',
        confirmButtonText:'Confirmar',
        showCancelButton: true
      }).then((result)=>{
        if(result.isConfirmed){
          this.axios.delete(`/api/unidad/${id}`).then(response=>{this.mostrarCompras()}).catch(error=>{console.log(error)});
          Swal.fire('Eliminado','','success')
        }else if(result.isDenied){}
      });
    }
  },
}
</script>