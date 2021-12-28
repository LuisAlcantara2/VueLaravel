<template>
<div class="container">
  <div class="row">
    <div>
      <router-link to="/crearProveedor" class="btn btn-success" custom v-slot="{ navigate }">
        <span @click="navigate" @keypress.enter="navigate" role="link"> <i class="fas fa-plus-circle"></i>  Nuevo</span>
      </router-link>
    </div>
    <div class="col-12"> 
      <div class="table-responsive">
        <table class="table table-border">
          <thead class="bg-primary text-white">
            <tr>
              <th>#</th>
              <th>Proveedor</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="proveedor in proveedores" :key="proveedor.id">
              <td>{{ proveedor.id}}</td>
              <td>{{ proveedor.pvd_nombre}}</td>
              <td>
                <router-link :to="{name:'editarProveedor', params: { id: proveedor.id }}" class="btn btn-info" custom v-slot="{ navigate }">
                  <span @click="navigate" @keypress.enter="navigate" role="link">Editar</span>
                </router-link>
                <a type="button" @click="borrarProveedor(proveedor.id)" class="btn btn-danger"> Eliminar </a>
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
  name:"proveedores",
  data(){
    return{
      proveedores:[]
    }
  },
  mounted(){
    this.mostrarProveedors()
  },
  methods: {
    async mostrarProveedors(){
      await this.axios.get('api/proveedor')
        .then(response=>{
          this.proveedores = response.data
        })
        .catch(error=>{
          this.proveedores = []
        })
    },
    borrarProveedor(id){
      Swal.fire({
        title:'¿Confirma eliminar el registro?',
        confirmButtonText:'Confirmar',
        showCancelButton: true
      }).then((result)=>{
        if(result.isConfirmed){
          this.axios.delete(`/api/proveedor/${id}`).then(response=>{this.mostrarCompras()}).catch(error=>{console.log(error)});
          Swal.fire('Eliminado','','success')
        }else if(result.isDenied){}
      });
    }
  },
}
</script>