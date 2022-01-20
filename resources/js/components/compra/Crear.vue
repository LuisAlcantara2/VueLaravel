
<template> 
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Crear Compra</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="crear">
                <div class="row">
                  <div class="col-4 mb-2">
                    <div class="form-group">
                      <label>Fecha de emisión</label>
                      <input type="date" class="form-control" v-model="compra.com_fecha">
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="form-group">
                      <label>Serie</label>
                      <input type="text" class="form-control" v-model="compra.com_serie">
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="form-group">
                      <label>Correlativo</label>
                      <input type="text" class="form-control" v-model="compra.com_correlativo">
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="form-group">
                      <label>Proveedor</label>
                      <a v-b-modal.modalProveedor>[+Nuevo]</a>
                      <b-form-select
                        v-model="proveedor_id"
                        :options="proveedores"
                        class="form-control"
                        value-field="id"
                        text-field="pvd_nombre"
                        @change="seleccionarProveedor"
                      ></b-form-select>
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="form-group">
                      <label>Documento</label>
                      <input type="text" class="form-control" v-model="proveedor.pvd_doc">
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="form-group">
                      <label>Dirección</label>
                      <input type="text" class="form-control" v-model="proveedor.pvd_direccion">
                    </div>
                  </div>
                  <div class="col-3 mb-2">
                    <div class="form-group">
                      <label>Producto</label>
                      <a @click="showModalProducto">[+Nuevo]</a>
                      <b-form-select
                        v-model="producto_id"
                        :options="productos"
                        class="form-control"
                        value-field="id"
                        text-field="pro_nombre"
                        @change="seleccionarProducto"
                      ></b-form-select>
                      <!-- <select v-model="productoSel" class="form-control" id="producto">
                        <option v-for="producto in productos" :key="producto.id" :value="producto.id">{{producto.pro_nombre}}</option>
                      </select> -->
                    </div>
                  </div>
                  <div class="col-3 mb-2">
                    <div class="form-group">
                      <label>Precio </label>
                      <input type="text" class="form-control" v-model="producto.pro_preciocompra">
                    </div>
                  </div>
                  <div class="col-3 mb-2">
                    <div class="form-group">
                      <label>Cantidad</label>
                      <input type="text" class="form-control" v-model="cantidad">
                    </div>
                  </div>
                  <div class="col-3 mt-4">
                    <b-button @click="agregarDetalle">Agregar Producto</b-button>
                  </div>
                  <div class="col-12"> 
                    <b-table
                      striped 
                      hover
                      show-empty
                      responsive
                      empty-text="Sin registros"
                      :items="compra.detalle"
                      :fields="fields"
                    >
                    <template v-slot:cell(Precio)="row" v-if="edit">
                      <b-form-input v-model="row.item.Precio"/>
                    </template>
                    
                    <template v-slot:cell(Cantidad)="row" v-if="edit">
                      <b-form-input v-model="row.item.Cantidad"/>
                    </template>
                      <template #cell(actions)="data">
                        <b-button
                          size="sm"
                          class="btn-info mr-1"
                          @click="editItem(data)"
                        >
                          {{ edit === data.item.id ? 'Guardar' : 'Editar' }}
                          <!-- <i class="fas fa-edit"></i> -->
                        </b-button>
                        <b-button
                          size="sm"
                          class="btn-danger mr-1"
                          @click="deleteItem(data.index)"
                        >
                          <i class="fas fa-trash"></i>
                        </b-button>
                      </template>
                    </b-table>
                  </div>
                  <div class="col-7"></div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Total</label>
                      <input class="text-end" type="text" v-model="compra.com_total">
                    </div>
                  </div>
                  <div class="col-2"></div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    <router-link :to="{name:'mostrarCompra'}" class="btn btn-secondary" custom v-slot="{ navigate }">
                      <span @click="navigate" @keypress.enter="navigate" role="link">Atras</span>
                    </router-link>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <b-modal
        id="modalProveedor"
        ref="modal"
        title="Crear Proveedor"
        hide-footer
        v-model="isModalVisible"
        @show="resetModal"
        @hidden="resetModal"
      >
        <form @submit.prevent="crearProveedor">
          <div class="row">
            <div class="col-12 mb-2">
              <div class="form-group">
                <label>Documento</label>
                <input type="text" class="form-control" v-model="proveedor.pvd_doc">
              </div>
            </div>
            <div class="col-12 mb-2">
              <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" v-model="proveedor.pvd_nombre">
              </div>
            </div>
            <div class="col-12 mb-2">
              <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control" v-model="proveedor.pvd_direccion">
              </div>
            </div>
            <div class="col-12 mb-2">
              <div class="form-group">
                <label>Telefono</label>
                <input type="text" class="form-control" v-model="proveedor.pvd_telefono">
              </div>
            </div>
            <div class="col-12">
              <button type="button" class="btn btn-primary" @click="crearProveedor">Guardar</button>
              <button type="button" class="btn btn-secondary" @click="hideModal">Cerrar</button>
            </div>
          </div>
        </form>
      </b-modal>

      <b-modal
        id="modalProducto"
        ref="modal"
        title="Crear Producto"
        hide-footer
        v-model="isModalProductoVisible"
        @show="resetModalProducto"
        @hidden="resetModalProducto"
      >
        <form @submit.prevent="crear">
          <div class="row">
            <div class="col-12 mb-2">
              <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" v-model="productoModal.pro_nombre">
              </div>
            </div>
            <div class="col-6 mb-2">
              <div class="form-group">
                <label>Stock actual</label>
                <input type="text" class="form-control" v-model="productoModal.pro_stockactual">
              </div>
            </div>
            <div class="col-6 mb-2">
              <div class="form-group">
                <label>Stock mínimo</label>
                <input type="text" class="form-control" v-model="productoModal.pro_stockmin">
              </div>
            </div>
            <div class="col-6 mb-2">
              <div class="form-group">
                <label>Precio Venta</label>
                <input type="text" class="form-control" v-model="productoModal.pro_precioventa">
              </div>
            </div>
            <div class="col-6 mb-2">
              <div class="form-group">
                <label>Precio Compra</label>
                <input type="text" class="form-control" v-model="productoModal.pro_preciocompra">
              </div>
            </div>
            <div class="col-6 mb-2">
              <div class="form-group">
                <label>Marca</label>
                <select v-model="productoModal.marca_id" class="form-control" id="marca">
                  <option v-for="marca in marcas" :key="marca.id" :value="marca.id">{{marca.mar_nombre}}</option>
                </select>
              </div>
            </div>
            <div class="col-6 mb-2">
              <div class="form-group">
                <label>Categoria</label>
                <select v-model="productoModal.categoria_id" class="form-control" id="categoria">
                  <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">{{categoria.cat_nombre}}</option>
              </select>
              </div>
            </div>
            <div class="col-6 mb-2">
              <div class="form-group">
                <label>Unidad de medida</label>
                <select v-model="productoModal.unidad_id" class="form-control" id="unidad">
                  <option v-for="unidad in unidades" :key="unidad.id" :value="unidad.id">{{unidad.uni_nombre}}</option>
              </select>
              </div>
            </div>
            <div class="col-12">
              <button type="button" class="btn btn-primary" @click="crearProducto">Guardar</button>
              <button type="button" class="btn btn-secondary" @click="hideModalProducto">Cerrar</button>
            </div>
          </div>
        </form>
      </b-modal>
    </div>
</template>

<script>
import { BModal, VBModal,BTable } from 'bootstrap-vue'
import moment from "moment";
export default{
  name : "crear-compra",
  components: {
      BModal,
      BTable,
    },
  data(){
    return {
      compra:{
        com_fecha:moment().format("YYYY-MM-DD"),
        com_serie:"",
        com_correlativo:"",
        proveedor_id:"",
        com_total:0,
        com_direccion:"-",
        detalle:[],
      },
      proveedores:[],
      proveedor_id:{

      },
      isModalVisible: false,
      proveedor:{
        pvd_doc:"",
        pvd_nombre:"",
        pvd_direccion:"",
        pvd_telefono:"",
      },
      isModal:false,
      producto:{},
      productos:[],
      producto_id:{
        // id:0,
        // pro_nombre:"",
        // pro_stockactual:0,
        // pro_preciocompra:"",
      },

      fields: [
        { key: 'Producto', label: 'Producto', sortable: false },
        { key: 'Precio', label: 'Precio', sortable: false, tdClass: 'text-end'},
        { key: 'Cantidad', label: 'Cantidad', sortable: false, tdClass: 'text-end'},
        { key: 'Subtotal', label: 'Subtotal', sortable: false, tdClass: 'text-end'},
        { key: 'actions', label: 'Acciones', tdClass: 'text-center', thClass: 'text-center', sortable: false },
      ],
      cantidad:"0",
      isModalProductoVisible: false,
      productoModal:{
        pro_nombre:"",
        pro_stockactual:"",
        pro_stockmin:"",
        pro_precioventa:"",
        pro_preciocompra:"",
        marca_id:{},
        categoria_id:{},
        unidad_id:{},
      },
      isModalProducto:false,
      marcas:[],
      categorias:[],
      unidades:[],
      edit: null,
    }
  },
  async mounted(){
    await this.getProductos()
    await this.getdata()
  },
  computed: {
    rows() {
      return this.compra.detalle.length
    }
  },
  methods:{
    async crear(){
      console.log('compra:',this.compra)
      await this.axios.post('/api/compra',this.compra)
        .then(response => {
          this.$router.push({name:"mostrarCompra"})
          Swal.fire('Registrado Correctamente','','success')
        })
        .catch(error=>{
          console.log(error)
        })
    },
    async getProductos(){
      await this.axios.get('/api/producto')
        .then(response=>{
          this.productos = response.data 
          if(this.isModalProducto)
          {
            this.producto_id = this.productos[this.productos.length-1].id 
          }
          else{
            this.producto_id = this.productos[0].id
          }
          this.seleccionarProducto()
        })
        .catch(error=>{
          this.marcas = []
        })
    },
    async getdata(){
      await this.axios.get('/api/proveedor')
        .then(response=>{
          this.proveedores = response.data 
          console.log('prove',this.proveedores)
          if(this.isModal){
            this.proveedor_id  = this.proveedores[this.proveedores.length-1].id
            console.log('llega')
          }
          else{
            this.proveedor_id  = this.proveedores[0].id
          }
          this.seleccionarProveedor()
        })
        .catch(error=>{
          this.marcas = []
        })
    },
    showModal() {
      this.isModalVisible=true
    },
    hideModal() {
      this.isModalVisible=false
    },
    resetModal() {
        this.proveedor.pvd_doc=""
        this.proveedor.pvd_nombre=""
        this.proveedor.pvd_direccion=""
        this.proveedor.pvd_telefono=""
    },
    async crearProveedor(){
      this.isModal = true
      await this.axios.post('/api/proveedor',this.proveedor)
        .then(response => {
            this.getdata()
            this.compra.com_direccion = response.data.proveedor.pvd_direccion
            this.isModalVisible=false
        })
        .catch(error=>{
          console.log(error)
        })
    },
    agregarDetalle(){
      this.compra.detalle.push(({id:this.producto.id,Producto: this.producto.pro_nombre,Precio:this.producto.pro_preciocompra,Cantidad:this.cantidad,Subtotal:this.producto.pro_preciocompra*this.cantidad}))
      this.compra.com_total += this.producto.pro_preciocompra*this.cantidad
      this.cantidad=0
    },
    deleteItem(index){
     this.compra.com_total -= this.compra.detalle[index].Subtotal
     this.$delete(this.compra.detalle,index)
     
    },
    editItem(id) {
      this.edit = this.edit !== id.item.id ? id.item.id : null;
      id.item.Subtotal = id.item.Precio * id.item.Cantidad
    },
   seleccionarProducto(){
     this.axios.get(`/api/producto/${this.producto_id}`)
      .then(response=>{
        this.producto = response.data
        console.log(response.data)
      })
      .catch(error=>{
        console.log(error)
      })
   },
   seleccionarProveedor(){
     this.axios.get(`/api/proveedor/${this.proveedor_id}`)
      .then(response=>{
        this.proveedor = response.data
        this.compra.proveedor_id =this.proveedor.id
        console.log(response.data)
      })
      .catch(error=>{
        console.log(error)
      })
   },
   showModalProducto() {
      this.isModalProductoVisible=true
      this.axios.get('/api/marca')
        .then(response=>{
          this.marcas = response.data
          this.productoModal.marca_id = this.marcas[0].id
        })
        .catch(error=>{
          this.marcas = []
        })
      this.axios.get('/api/unidad')
        .then(response=>{
          this.unidades = response.data
          this.productoModal.unidad_id = this.unidades[0].id          
        })
        .catch(error=>{
          this.marcas = []
        })
      this.axios.get('/api/categoria')
        .then(response=>{
          this.categorias = response.data
          this.productoModal.categoria_id = this.categorias[0].id
        })
        .catch(error=>{
          this.marcas = []
        })
    },
    hideModalProducto() {
      this.isModalProductoVisible=false
    },
    resetModalProducto() {
        this.productoModal.pro_nombre=""
        this.productoModal.pro_stockactual=""
        this.productoModal.pro_stockmin=""
        this.productoModal.pro_precioventa=""
        this.productoModal.pro_preciocompra=""
    },
    async crearProducto(){
      this.isModalProducto = true
      await this.axios.post('/api/producto',this.productoModal)
        .then(response => {
            this.getProductos()
            this.isModalProductoVisible=false
        })
        .catch(error=>{
          console.log(error)
        })
    },
  }
}
</script>