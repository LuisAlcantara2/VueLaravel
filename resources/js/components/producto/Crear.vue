<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Crear Producto</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="crear">
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
                      <a v-b-modal.modalMarca>[+Nuevo]</a>
                      <select v-model="producto.marca_id" class="form-control" id="marca">
                        <option v-for="marca in marcas" :key="marca.id" :value="marca.id">{{marca.mar_nombre}}</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-6 mb-2">
                    <div class="form-group">
                      <label>Categoria</label>
                      <a v-b-modal.modalCategoria>[+Nuevo]</a>
                      <select v-model="producto.categoria_id" class="form-control" id="categoria">
                        <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{categoria.cat_nombre}}</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-6 mb-2">
                    <div class="form-group">
                      <label>Unidad de medida</label>
                      <a v-b-modal.modalUnidad>[+Nuevo]</a>
                      <select v-model="producto.unidad_id" class="form-control" id="unidad">
                        <option v-for="unidad in unidades" :key="unidad.id" :value="unidad.id">{{unidad.uni_nombre}}</option>
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
      <b-modal
        id="modalUnidad"
        ref="modal"
        title="Crear Unidad"
        hide-footer
        v-model="isModalUnidadVisible"
        @show="resetModalUnidad"
        @hidden="resetModalUnidad"
        >
        <form @submit.prevent="crear">
          <div class="row">
            <div class="col-12 mb-2">
              <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" v-model="unidad.uni_nombre">
              </div>
            </div>
            <div class="col-12">
              <button type="button" class="btn btn-primary" @click="crearUnidad">Guardar</button>
              <button type="button" class="btn btn-secondary" @click="hideUnidad">Cerrar</button>
            </div>
          </div>

        </form>

      </b-modal>
      <b-modal
        id="modalCategoria"
        ref="modal"
        title="Crear Categoria"
        hide-footer
        v-model="isModalCategoriaVisible"
        @show="resetModalCategoria"
        @hidden="resetModalCategoria"
      >
      <form @submit.prevent="crear">
        <div class="row">
          <div class="col-12 mb-2">
            <div class="form-group">
              <label>Nombre</label>
              <input type="text" class="form-control" v-model="categoria.cat_nombre">
            </div>
          </div>
          <div class="col-12">
            <button type="button" class="btn btn-primary" @click="crearCategoria">Guardar</button>
              <button type="button" class="btn btn-secondary" @click="hideCategoria">Cerrar</button>
          </div>
        </div>

      </form> 
      </b-modal>
      <b-modal
        id="modalMarca"
        ref="modal"
        title="Crear Marca"
        hide-footer
        v-model="isModalMarcaVisible"
        @show="resetModalMarca"
        @hidden="resetModalMarca"
      >
      <form @submit.prevent="crear">
        <div class="row">
          <div class="col-12 mb-2">
            <div class="form-group">
              <label>Nombre</label>
              <input type="text" class="form-control" v-model="marca.mar_nombre">
            </div>
          </div>
          <div class="col-12">
            <button type="button" class="btn btn-primary" @click="crearMarca">Guardar</button>
              <button type="button" class="btn btn-secondary" @click="hideMarca">Cerrar</button>
          </div>
        </div>

      </form> 
      </b-modal>
    </div>
</template>
<script>
import { BModal, VBModal } from 'bootstrap-vue'

export default{
  name : "crear-producto",
  components: {
      BModal,
    },
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
      categorias:[],
      unidades:[],
      isModalUnidadVisible:false,
      isModalUnidad:false,
      unidad:{
        uni_nombre:"",
      },
      isModalCategoriaVisible:false,
      isModalCategoria:false,
      categoria:{
        cat_nombre:"",
      },
      isModalMarcaVisible:false,
      isModalMarca:false,
      marca:{
        mar_nombre:"",
      },
    }
  },
  mounted(){
    this.getdata()
  },
  methods:{
    async crear(){
      console.log(this.producto)
      await this.axios.post('/api/producto',this.producto)
        .then(response => {
          this.$router.push({name:"mostrarProducto"})
        })
        .catch(error=>{
          console.log(error)
        })
    },
    async getdata(){
      await this.axios.get('/api/marca')
        .then(response=>{
          this.marcas = response.data
          this.producto.marca_id = this.marcas[0].id
          if(this.isModalMarca)
          {
            this.producto.marca_id = this.marcas[this.marcas.length-1].id
          }
        })
        .catch(error=>{
          this.marcas = []
        })
      await this.axios.get('/api/unidad')
        .then(response=>{
          this.unidades = response.data
          this.producto.unidad_id = this.unidades[0].id
          if(this.isModalUnidad)
          {
            this.producto.unidad_id = this.unidades[this.unidades.length-1].id
          }
        })
        .catch(error=>{
          this.marcas = []
        })
      await this.axios.get('/api/categoria')
        .then(response=>{
          this.categorias = response.data
          this.producto.categoria_id = this.categorias[0].id
          if(this.isModalCategoria)
          {
            this.producto.categoria_id = this.categorias[this.categorias.length-1].id
          }
        })
        .catch(error=>{
          this.marcas = []
        })
    },
    showModalUnidad() {
      this.isModalUnidadVisible=true
    },
    hideUnidad() {
      this.isModalUnidadVisible=false
    },
    resetModalUnidad() {
        this.unidad.uni_nombre=""
    },
    async crearUnidad(){
      this.isModalUnidad = true
      await this.axios.post('/api/unidad',this.unidad)
        .then(response => {
            this.getdata()
            this.isModalUnidadVisible=false
        })
        .catch(error=>{
          console.log(error)
        })
    },
    showModalCategoria() {
      this.isModalCategoriaVisible=true
    },
    hideCategoria() {
      this.isModalCategoriaVisible=false
    },
    resetModalCategoria() {
        this.categoria.cat_nombre=""
    },
    async crearCategoria(){
      this.isModalCategoria = true
      await this.axios.post('/api/categoria',this.categoria)
        .then(response => {
            this.getdata()
            this.isModalCategoriaVisible=false
        })
        .catch(error=>{
          console.log(error)
        })
    },
    showModalMarca() {
      this.isModalMarcaVisible=true
    },
    hideMarca() {
      this.isModalMarcaVisible=false
    },
    resetModalMarca() {
        this.marca.mar_nombre=""
    },
    async crearMarca(){
      this.isModalMarca = true
      await this.axios.post('/api/marca',this.marca)
        .then(response => {
            this.getdata()
            this.isModalMarcaVisible=false
        })
        .catch(error=>{
          console.log(error)
        })
    },
  }
}
</script>