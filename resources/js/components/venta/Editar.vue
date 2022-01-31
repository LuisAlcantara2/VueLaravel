<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Editar Venta</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="actualizar">
                <div class="row">
                  <div class="col-4 mb-2">
                    <div class="form-group">
                      <label>Fecha de emisión</label>
                      <input type="date" readonly class="form-control" v-model="venta.ven_fecha">
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="form-group">
                      <label>Serie</label>
                      <input readonly type="text" class="form-control" v-model="venta.ven_serie">
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="form-group">
                      <label>Correlativo</label>
                      <input readonly type="text" class="form-control" v-model="venta.ven_correlativo">
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="form-group">
                      <label>Cliente</label>
                      <a v-b-modal.modalCliente>[+Nuevo]</a>
                      <b-form-select
                        v-model="cliente_id"
                        :options="clientes"
                        class="form-control"
                        value-field="id"
                        text-field="cli_nombre"
                        @change="seleccionarCliente"
                      ></b-form-select>
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="form-group">
                      <label>Documento</label>
                      <input readonly type="text" class="form-control" v-model="cliente.cli_doc">
                    </div>
                  </div>
                  <div class="col-4 mb-2">
                    <div class="form-group">
                      <label>Dirección</label>
                      <input readonly type="text" class="form-control" v-model="cliente.cli_direccion">
                    </div>
                  </div>
                  <div class="col-3 mb-2">
                    <div class="form-group">
                      <label>Producto</label>
                      <a v-b-modal.modalProducto>[+Nuevo]</a>
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
                      <input type="number" class="form-control" v-model="producto.pro_precioventa">
                    </div>
                  </div>
                  <div class="col-3 mb-2">
                    <div class="form-group">
                      <label>Cantidad</label>
                      <input type="number" class="form-control" v-model="cantidad">
                    </div>
                  </div>
                  <div class="col-3 mt-4">
                    <b-button @click="agregarDetalle"><i class="fas fa-plus-circle"></i> Agregar Producto</b-button>
                  </div>
                  <div class="col-12"> 
                    <b-table
                      striped 
                      hover
                      show-empty
                      responsive
                      empty-text="Sin registros"
                      :items="venta.detalle"
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
                      <input readonly class="text-end" type="text" v-model="venta.ven_total">
                    </div>
                  </div>
                  <div class="col-2"></div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    <router-link :to="{name:'mostrarVenta'}" class="btn btn-secondary" custom v-slot="{ navigate }">
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
        id="modalCliente"
        ref="modal"
        title="Crear Cliente"
        hide-footer
        v-model="isModalVisible"
        @show="resetModal"
        @hidden="resetModal"
      >
        <form @submit.prevent="crearCliente">
          <div class="row">
            <div class="col-12 mb-2">
              <div class="form-group">
                <label>Documento</label>
                <input type="text" class="form-control" v-model="cliente.cli_doc">
              </div>
            </div>
            <div class="col-12 mb-2">
              <div class="form-group">
                <label>Nombre</label>
                <input type="text" class="form-control" v-model="cliente.cli_nombre">
              </div>
            </div>
            <div class="col-12 mb-2">
              <div class="form-group">
                <label>Dirección</label>
                <input type="text" class="form-control" v-model="cliente.cli_direccion">
              </div>
            </div>
            <div class="col-12 mb-2">
              <div class="form-group">
                <label>Telefono</label>
                <input type="text" class="form-control" v-model="cliente.cli_telefono">
              </div>
            </div>
            <div class="col-12">
              <button type="button" class="btn btn-primary" @click="crearCliente"><i class="fas fa-save"></i> Guardar</button>
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
export default{
  name : "editar-venta",
  components: {
      BModal,
      BTable,
    },
  data(){
    return {
      venta:{
        ven_fecha:"",
        ven_serie:"",
        ven_correlativo:"",
        cliente_id:"",
        ven_total:0,
        ven_direccion:"-",
        detalle:[],
      },
      clientes:[],
      cliente_id:{},
      isModalVisible: false,
      cliente:{
        cli_doc:"",
        cli_nombre:"",
        cli_direccion:"",
        cli_telefono:"",
      },
      isModal:false,
      producto:{
        pro_nombre:"",
        pro_precioventa:0,
        pro_id:0,
      },
      productos:[],
      producto_id:{},
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
      serie_id:{},
      serie:'',
      series:[],
    }
  },
  mounted(){
    this.mostrarVenta()
    this.getProductos()
    this.getdata()
    this.getSerie()
  },
  computed: {
    rows() {
      return this.venta.detalle.length
    }
  },
  methods:{
    async actualizar(){
      await this.axios.put(`/api/venta/${this.$route.params.id}`,this.venta)
        .then(response => {
          this.$router.push({name:"mostrarVenta"})
        })
        .catch(error=>{
          console.log(error)
        })
    },
    async mostrarVenta(){
      await this.axios.get(`/api/venta/${this.$route.params.id}`)
      .then(response=>{
        this.venta= response.data.venta
        console.log(this.venta)
      })
      .catch(error=>{
        console.log(error)
      })
    },
    showModal() {
      this.isModalVisible=true
    },
    hideModal() {
      this.isModalVisible=false
    },
    resetModal() {
        this.cliente.cli_doc=""
        this.cliente.cli_nombre=""
        this.cliente.cli_direccion=""
        this.cliente.cli_telefono=""
    },
    async crearCliente(){
      this.isModal = true
      await this.axios.post('/api/cliente',this.cliente)
        .then(response => {
            this.getdata()
            this.venta.ven_direccion = response.data.cliente.cli_direccion
            this.isModalVisible=false
        })
        .catch(error=>{
          console.log(error)
        })
    },
    agregarDetalle(){
      this.venta.detalle.push(({id:this.producto.id,Producto: this.producto.pro_nombre,Precio:this.producto.pro_precioventa,Cantidad:Number(this.cantidad),Subtotal:this.producto.pro_precioventa*this.cantidad}))
      this.venta.ven_total += Number(this.producto.pro_precioventa)*Number(this.cantidad)
      this.cantidad=0
    },
    deleteItem(index){
     this.venta.ven_total -= this.venta.detalle[index].Subtotal
     this.$delete(this.venta.detalle,index)
     
    },
    editItem(id) {
      this.edit = this.edit !== id.item.id ? id.item.id : null;
      id.item.Subtotal = id.item.Precio * id.item.Cantidad
    },
    seleccionarProducto(){
     this.axios.get(`/api/producto/${this.producto_id}`)
      .then(response=>{
        this.producto = response.data
        console.log('Select pro',this.producto)
      })
      .catch(error=>{
        console.log(error)
      })
    },
    seleccionarCliente(){
     this.axios.get(`/api/cliente/${this.cliente_id}`)
      .then(response=>{
        this.cliente = response.data
        this.venta.cliente_id =this.cliente.id
        console.log(response.data)
      })
      .catch(error=>{
        console.log(error)
      })
    },
    seleccionarSerie(){
     this.axios.get(`/api/serie/${this.serie_id}`)
      .then(response=>{
        this.serie = response.data
        this.venta.ven_serie =this.serie.ser_serie
        this.venta.ven_correlativo =this.serie.ser_corre
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
        this.productoModal.pro_precioventa=""
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
      await this.axios.get('/api/cliente')
        .then(response=>{
          this.clientes = response.data 
          console.log('prove',this.clientes)
          if(this.isModal){
            this.cliente_id  = this.clientes[this.clientes.length-1].id
          }
          else{
            this.cliente_id  = this.venta.cliente_id
          }
          console.log('dasd',this.venta.cliente_id)
          this.seleccionarCliente()
        })
        .catch(error=>{
          this.marcas = []
        })
    },
    async getSerie(){
      await this.axios.get('/api/serie')
        .then(response=>{
          this.series = response.data
        })
        .catch(error=>{
          this.series = []
        })
    },
  }
}
</script>