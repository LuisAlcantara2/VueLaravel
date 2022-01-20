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
      <button class="btn btn-primary" @click="mostrarUnidades"><i class="fas fa-search"></i> Filtrar</button>
    </div>
  </div>
  <div class="row">
    <div>
      <router-link to="/crearUnidad" class="btn btn-success" custom v-slot="{ navigate }">
        <span @click="navigate" @keypress.enter="navigate" role="link"> <i class="fas fa-plus-circle"></i>  Nuevo</span>
      </router-link>
    </div>
    <div class="col-12 mt-3">
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
                  <span @click="navigate" @keypress.enter="navigate" role="link"><i class="fas fa-edit"></i> Editar</span>
                </router-link>
                <a type="button" @click="borrarUnidad(unidad.id)" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar </a>
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
      unidades:[],
      filtro:'',
    }
  },
  mounted(){
    this.mostrarUnidades()
  },
  methods: {
    async mostrarUnidades(){
      await this.axios.get('api/unidad',{
        params:{
          filtro:this.filtro
        }
      }).then(response=>{
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
          this.axios.delete(`/api/unidad/${id}`).then(response=>{this.mostrarUnidades()}).catch(error=>{console.log(error)});
          Swal.fire('Eliminado','','success')
        }else if(result.isDenied){}
      });
    }
  },
}
</script>