<template>
<div class="container">
  <div class="row">
    <div class="col-auto">
      <label for="">Busqueda</label>
    </div>
    <div class="col-auto">
      <input class="form-control" v-model="filtro" type="text">
    </div>
    <div class="col-auto">
      <button class="btn btn-primary" @click="mostrarMarcas"><i class="fas fa-search"></i> Filtrar</button>
      <button v-if="filtro.length>0" class="btn btn-warning" @click.prevent="Reset"><i class="fas fa-ban"></i> Limpiar</button>
    </div>
  </div>
  <div class="row">
    <div>
      <router-link to="/crearMarca" class="btn btn-success" custom v-slot="{ navigate }">
        <span @click="navigate" @keypress.enter="navigate" role="link"> <i class="fas fa-plus-circle"></i>  Nuevo</span>
      </router-link>
    </div>
    <div class="col-12 mt-3">
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
            <tr v-for="(marca,index) in marcas" :key="marca.id">
              <td>{{ index+1}}</td>
              <td>{{ marca.mar_nombre}}</td>
              <td>
                <router-link :to="{name:'editarMarca', params: { id: marca.id }}" class="btn btn-info" custom v-slot="{ navigate }">
                  <span @click="navigate" @keypress.enter="navigate" role="link"><i class="fas fa-edit"></i> Editar</span>
                </router-link>
                <a type="button" @click="borrarMarca(marca.id)" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar </a>
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
      marcas:[],
      filtro:'',
    }
  },
  mounted(){
    this.mostrarMarcas()
  },
  methods: {
    async mostrarMarcas(){
      await this.axios.get('api/marca',{
        params:{
          filtro:this.filtro
        }
      }).then(response=>{
          this.marcas = response.data
        })
        .catch(error=>{
          this.marcas = []
        })
    },
    Reset(){
      this.filtro=''
      this.mostrarUnidades()
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