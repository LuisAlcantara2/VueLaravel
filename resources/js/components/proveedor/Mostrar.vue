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
      <button class="btn btn-primary" @click="mostrarProveedores"><i class="fas fa-search"></i> Filtrar</button>
    </div>
  </div>
  <div class="row">
    <div>
      <router-link to="/crearProveedor" class="btn btn-success" custom v-slot="{ navigate }">
        <span @click="navigate" @keypress.enter="navigate" role="link"> <i class="fas fa-plus-circle"></i>  Nuevo</span>
      </router-link>
    </div>
    <div class="col-12 mt-3">
      <div class="table-responsive">
        <table class="table table-border">
          <thead class="bg-primary text-white">
            <tr>
              <th>#</th>
              <th>Proveedor</th>
              <th>Nro. Documento</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="proveedor in proveedores" :key="proveedor.id">
              <td>{{ proveedor.id}}</td>
              <td>{{ proveedor.pvd_nombre}}</td>
              <td>{{ proveedor.pvd_doc}}</td>
              <td>
                <router-link :to="{name:'editarProveedor', params: { id: proveedor.id }}" class="btn btn-info" custom v-slot="{ navigate }">
                  <span @click="navigate" @keypress.enter="navigate" role="link"><i class="fas fa-edit"></i> Editar</span>
                </router-link>
                <a type="button" @click="borrarProveedor(proveedor.id)" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar </a>
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
      proveedores:[],
      filtro:'',
    }
  },
  mounted(){
    this.mostrarProveedores()
  },
  methods: {
    async mostrarProveedores(){
      await this.axios.get('api/proveedor',{
        params:{
          filtro:this.filtro
        }
      }).then(response=>{
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
          this.axios.delete(`/api/proveedor/${id}`).then(response=>{this.mostrarProveedores()}).catch(error=>{console.log(error)});
          Swal.fire('Eliminado','','success')
        }else if(result.isDenied){}
      });
    }
  },
}
</script>