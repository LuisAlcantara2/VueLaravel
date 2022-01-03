<template>
<div class="container">
  <div class="row">
    <div>
      <router-link to="/crearCategoria" class="btn btn-success" custom v-slot="{ navigate }">
        <span @click="navigate" @keypress.enter="navigate" role="link"> <i class="fas fa-plus-circle"></i>  Nuevo</span>
      </router-link>
    </div>
    <div class="col-12"> 
      <div class="table-responsive">
        <table class="table table-border">
          <thead class="bg-primary text-white">
            <tr>
              <th>#</th>
              <th>Categoria</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="categoria in categorias" :key="categoria.id">
              <td>{{ categoria.id}}</td>
              <td>{{ categoria.cat_nombre}}</td>
              <td>
                <router-link :to="{name:'editarCategoria',params: { id: categoria.id }}" class="btn btn-info" custom v-slot="{ navigate }">
                  <span @click="navigate" @keypress.enter="navigate" role="link">Editar</span>
                </router-link>
                <a type="button" @click="borrarCategoria(categoria.id)" class="btn btn-danger"> Eliminar </a>
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
  name:"categorias",
  data(){
    return{
      categorias:[]
    }
  },
  mounted(){
    this.mostrarCategorias()
  },
  methods: {
    async mostrarCategorias(){
      await this.axios.get('api/categoria')
        .then(response=>{
          this.categorias = response.data
        })
        .catch(error=>{
          this.categorias = []
        })
    },
    borrarCategoria(id){
      Swal.fire({
        title:'¿Confirma eliminar el registro?',
        confirmButtonText:'Confirmar',
        showCancelButton: true
      }).then((result)=>{
        if(result.isConfirmed){
          this.axios.delete(`/api/categoria/${id}`).then(response=>{this.mostrarCategorias()}).catch(error=>{console.log(error)});
          Swal.fire('Eliminado','','success')

        }else if(result.isDenied){}
      });
    }
  },
}
</script>