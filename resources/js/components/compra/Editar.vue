<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Editar Producto</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="actualizar">
                <div class="row">
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" v-model="producto.pro_nombre">
                    </div>
                  </div>
                  <div class="col-6 mb-2">
                    <div class="form-group">
                      <label>Stock actual</label>
                      <input type="text" class="form-control" v-model="producto.pro_stockactual">
                    </div>
                  </div>
                  <div class="col-6 mb-2">
                    <div class="form-group">
                      <label>Stock mínimo</label>
                      <input type="text" class="form-control" v-model="producto.pro_stockmin">
                    </div>
                  </div>
                  <div class="col-6 mb-2">
                    <div class="form-group">
                      <label>Precio Venta</label>
                      <input type="text" class="form-control" v-model="producto.pro_precioventa">
                    </div>
                  </div>
                  <div class="col-6 mb-2">
                    <div class="form-group">
                      <label>Precio Compra</label>
                      <input type="text" class="form-control" v-model="producto.pro_preciocompra">
                    </div>
                  </div>
                  <div class="col-6 mb-2">
                    <div class="form-group">
                      <label>Marca</label>
                      <select v-model="producto.marca_id" class="form-control" id="marca">
                        <option v-for="marca in marcas" :key="marca.id" :value="marca.id">{{marca.mar_nombre}}</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-6 mb-2">
                    <div class="form-group">
                      <label>Categoria</label>
                      <select v-model="producto.categoria_id" class="form-control" id="categoria">
                        <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{categoria.cat_nombre}}</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-6 mb-2">
                    <div class="form-group">
                      <label>Unidad de medida</label>
                      <select v-model="producto.unidad_id" class="form-control" id="unidad">
                        <option v-for="unidad in unidades" :key="unidad.id" :value="unidad.id" :selected="unidadSelected.id === unidad.id"  >{{unidad.uni_nombre}}</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
export default{
  name : "editar-producto",
  data(){
    return {
      producto:{
        pro_nombre:"",
        pro_stockactual:"",
        pro_stockmin:"",
        pro_precioventa:"",
        pro_preciocompra:"",
        marca_id:{},
        categoria_id:{},
        unidad_id:{},
      },
      marcas:[],
      marcaSelected:{},
      categorias:[],
      categoriaSelected:{},
      unidades:[],
      unidadSelected:{},
    }
  },
  mounted(){
    this.getdata()
    this.mostrarProducto()
  },
  methods:{
    async actualizar(){
      await this.axios.put(`/api/producto/${this.$route.params.id}`,this.producto)
        .then(response => {
          this.$router.push({name:"mostrarProducto"})
        })
        .catch(error=>{
          console.log(error)
        })
    },
    async mostrarProducto(){
      await this.axios.get(`/api/producto/${this.$route.params.id}`)
      .then(response=>{
        this.producto = response.data
        console.log(this.producto)
      })
      .catch(error=>{
        console.log(error)
      })
    },
    async getdata(){
      await this.axios.get('/api/marca')
        .then(response=>{
          this.marcas = response.data
        })
        .catch(error=>{
          this.marcas = []
        })
      await this.axios.get('/api/unidad')
        .then(response=>{
          this.unidades = response.data
        })
        .catch(error=>{
          this.marcas = []
        })
      await this.axios.get('/api/categoria')
        .then(response=>{
          this.categorias = response.data
        })
        .catch(error=>{
          this.marcas = []
        })
    },
  }
}
</script>