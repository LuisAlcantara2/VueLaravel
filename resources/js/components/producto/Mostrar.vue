<template>
<div class="container">
  <div class="row">
    <div>
      <router-link to="/crearProducto" class="btn btn-success" custom v-slot="{ navigate }">
        <span @click="navigate" @keypress.enter="navigate" role="link"> <i class="fas fa-plus-circle"></i>  Nuevo</span>
      </router-link>
    </div>
    <div class="col-12 mt-3">
      <div class="table-responsive">
        <table class="table table-border">
          <thead class="bg-primary text-white">
            <tr>
              <th>#</th>
              <th>Producto</th>
              <th>Stock</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="producto in productos" :key="producto.id">
              <td>{{ producto.id}}</td>
              <td>{{ producto.pro_nombre}}</td>
              <td>{{ producto.pro_stockactual}}</td>
              <td>
                <router-link :to="{ name: 'editarProducto', params: { id: producto.id }}" class="btn btn-info" custom v-slot="{ navigate }">
                  <span @click="navigate" @keypress.enter="navigate" role="link">Editar</span>
                </router-link>
                <a type="button" @click="borrarProducto(producto.id)" class="btn btn-danger"> Eliminar </a>
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
  name:"productos",
  data(){
    return{
      productos:[]
    }
  },
  mounted(){
    this.mostrarProductos()
  },
  methods: {
    async mostrarProductos(){
      await this.axios.get('api/producto')
        .then(response=>{
          this.productos = response.data
        })
        .catch(error=>{
          this.productos = []
        })
    },
    borrarProducto(id){
      Swal.fire({
        title:'¿Confirma eliminar el registro?',
        confirmButtonText:'Confirmar',
        showCancelButton: true
      }).then((result)=>{
        if(result.isConfirmed){
          this.axios.delete(`/api/producto/${id}`).then(response=>{this.mostrarProductos()}).catch(error=>{console.log(error)});
          Swal.fire('Eliminado','','success')
        }else if(result.isDenied){}
      });
    }
  },
}
</script>