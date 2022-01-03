<template>
<div class="container">
  <div class="row">
    <div>
      <router-link to="/crearCliente" class="btn btn-success" custom v-slot="{ navigate }">
        <span @click="navigate" @keypress.enter="navigate" role="link"> <i class="fas fa-plus-circle"></i>  Nuevo</span>
      </router-link>
    </div>
    <div class="col-12 mt-3">
      <div class="table-responsive">
        <table class="table table-border">
          <thead class="bg-primary text-white">
            <tr>
              <th>#</th>
              <th>Cliente</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="cliente in clientes" :key="cliente.id">
              <td>{{ cliente.id}}</td>
              <td>{{ cliente.cli_nombre}}</td>
              <td>
                <router-link :to="{name:'editarCliente', params: { id: cliente.id }}" class="btn btn-info" custom v-slot="{ navigate }">
                  <span @click="navigate" @keypress.enter="navigate" role="link">Editar</span>
                </router-link>
                <a type="button" @click="borrarCliente(cliente.id)" class="btn btn-danger"> Eliminar </a>
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
  name:"clientes",
  data(){
    return{
      clientes:[]
    }
  },
  mounted(){
    this.mostrarClientes()
  },
  methods: {
    async mostrarClientes(){
      await this.axios.get('api/cliente')
        .then(response=>{
          this.clientes = response.data
        })
        .catch(error=>{
          this.clientes = []
        })
    },
    borrarCliente(id){
      Swal.fire({
        title:'¿Confirma eliminar el registro?',
        confirmButtonText:'Confirmar',
        showCancelButton: true
      }).then((result)=>{
        if(result.isConfirmed){
          this.axios.delete(`/api/cliente/${id}`).then(response=>{this.mostrarClientes()}).catch(error=>{console.log(error)});
          Swal.fire('Eliminado','','success')
        }else if(result.isDenied){}
      });
    }
  },
}
</script>