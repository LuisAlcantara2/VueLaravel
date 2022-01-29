<template>
<div class="container">
  <div class="row">
    <div class="col-auto">
      <label for="">Busqueda</label>
    </div>
    <div class="col-auto">
      <input class="form-control" v-model="nombre" type="text">
    </div>
    <div class="col-auto">
      <button class="btn btn-primary" @click="mostrarProductos"><i class="fas fa-search"></i> Filtrar</button>
      <button v-if="nombre.length>0" class="btn btn-warning" @click.prevent="Reset"><i class="fas fa-ban"></i> Limpiar</button>
    </div>
  </div>
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
              <th>Precio venta</th>
              <th>Stock Actual</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="producto in productos" :key="producto.id">
              <td>{{ producto.id}}</td>
              <td>{{ producto.pro_nombre}}</td>
              <td >{{ producto.pro_precioventa}}</td>
              <td v-bind:class = "(producto.pro_stockactual<=producto.pro_stockmin)?'text-danger':''"><strong> {{ producto.pro_stockactual}}</strong></td>
              <td>
                <router-link :to="{ name: 'editarProducto', params: { id: producto.id }}" class="btn btn-info" custom v-slot="{ navigate }">
                  <span @click="navigate" @keypress.enter="navigate" role="link"><i class="fas fa-edit"></i>Editar</span>
                </router-link>
                <router-link :to="{ name: 'movimientoProducto', params: { id: producto.id }}" class="btn btn-warning" custom v-slot="{ navigate }">
                  <span @click="navigate" @keypress.enter="navigate" role="link"><i class="fas fa-eye"></i> Movimientos</span>
                </router-link>
                <a type="button" @click="borrarProducto(producto.id)" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar </a>
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
      productos:[],
      nombre:''
    }
  },
  mounted(){
    this.mostrarProductos()
  },
  methods: {
    async mostrarProductos(){
      await this.axios.get('api/producto',{
        params:{
          nombre:this.nombre
        }
      }).then(response=>{
          this.productos = response.data
        })
        .catch(error=>{
          this.productos = []
        })
    },
    Reset(){
      this.nombre=''
      this.mostrarProductos()
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