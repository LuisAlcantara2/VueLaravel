<template>
<div class="container">
  <div class="row">
    <div>
      <router-link to="/crearMarca" class="btn btn-success" custom v-slot="{ navigate }">
        <span @click="navigate" @keypress.enter="navigate" role="link"> <i class="fas fa-plus-circle"></i>  Nuevo</span>
      </router-link>
    </div>
    <div class="col-12"> 
      <div class="table-responsive">
        <table class="table table-border">
          <thead class="bg-primary text-white">
            <tr>
              <th>#</th>
              <th>Marca</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="marca in marcas" :key="marca.id">
              <td>{{ marca.id}}</td>
              <td>{{ marca.mar_nombre}}</td>
              <td>
                <router-link :to="{name:'editarMarca', params: { id: marca.id }}" class="btn btn-info" custom v-slot="{ navigate }">
                  <span @click="navigate" @keypress.enter="navigate" role="link">Editar</span>
                </router-link>
                <a type="button" @click="borrarMarca(marca.id)" class="btn btn-danger"> Eliminar </a>
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
  name:"marcas",
  data(){
    return{
      marcas:[]
    }
  },
  mounted(){
    this.mostrarMarcas()
  },
  methods: {
    async mostrarMarcas(){
      await this.axios.get('api/marca')
        .then(response=>{
          this.marcas = response.data
        })
        .catch(error=>{
          this.marcas = []
        })
    },
    borrarMarca(id){
      Swal.fire({
        title:'¿Confirma eliminar el registro?',
        confirmButtonText:'Confirmar',
        showCancelButton: true
      }).then((result)=>{
        if(result.isConfirmed){
          this.axios.delete(`/api/marca/${id}`).then(response=>{this.mostrarMarcas()}).catch(error=>{console.log(error)});
          Swal.fire('Eliminado','','success')
        }else if(result.isDenied){}
      });
    }
  },
}
</script>