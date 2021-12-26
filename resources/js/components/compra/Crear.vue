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
                  <div class="col-6 mb-2">
                    <div class="form-group">
                      <label>Proveedor</label>
                      <a v-b-modal.modalProveedor>[+Nuevo]</a>
                      <select v-model="compra.proveedor_id" class="form-control" id="proveedor">
                        <option v-for="proveedor in proveedores" :key="proveedor.id" :value="proveedor.id">{{proveedor.pvd_nombre}}</option>
                    </select>
                    </div>
                  </div>
                  <div class="col-6 mb-2">
                    <div class="form-group">
                      <label>Dirección</label>
                      <input type="text" class="form-control" v-model="compra.com_direccion">
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
                      show-empty
                      responsive
                      empty-text="Sin registros"
                      :items="compra.detalle"
                      :fields="fields"
                    >
                      <template #cell(actions)="data">
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
                    <button type="submit" class="btn btn-primary">Guardar</button>
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
    </div>
</template>

<script>
import { BModal, VBModal } from 'bootstrap-vue'
export default{
  name : "crear-compra",
  components: {
      BModal,
    },
  data(){
    return {
      compra:{
        com_fecha:"",
        com_serie:"",
        com_correlativo:"",
        proveedor_id:{},
        com_total:0,
        com_direccion:"",
        detalle: [],
      },
      proveedores:[],
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
        { key: 'Producto', label: 'Producto', sortable: true },
        { key: 'Precio', label: 'Precio', sortable: true, tdClass: 'text-end'},
        { key: 'Cantidad', label: 'Cantidad', sortable: true, tdClass: 'text-end'},
        { key: 'Subtotal', label: 'Subtotal', sortable: true, tdClass: 'text-end'},
        { key: 'actions', label: 'Acciones', tdClass: 'text-center', thClass: 'text-center', sortable: false },
      ],
      cantidad:"0",
    }
  },
  async mounted(){
    await this.getdata()
    await this.getProductos()
  },
  methods:{
    async crear(){
      console.log('compra:',this.compra)
      await this.axios.post('/api/compra',this.compra)
        .then(response => {
          this.$router.push({name:"mostrarCompra"})
        })
        .catch(error=>{
          console.log(error)
        })
    },
    async getProductos(){
      this.axios.get('/api/producto')
        .then(response=>{
          this.productos = response.data 
          this.producto_id = this.productos[0].id
          this.seleccionarProducto()
        })
        .catch(error=>{
          this.marcas = []
        })
    },
    getdata(){
      this.axios.get('/api/proveedor')
        .then(response=>{
          this.proveedores = response.data 
          if(this.isModal){
            this.compra.proveedor_id  = this.proveedores[this.proveedores.length-1].id
          }
          else{
            this.compra.proveedor_id  = this.proveedores[0].id
          }
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
      this.compra.detalle.push(({Producto: this.producto.pro_nombre,Precio:this.producto.pro_preciocompra,Cantidad:this.cantidad,Subtotal:this.producto.pro_preciocompra*this.cantidad}))
      this.compra.com_total += this.producto.pro_preciocompra*this.cantidad
      this.cantidad=0
    },
    deleteItem(index){
     this.compra.com_total -= this.compra.detalle[index].Subtotal
     this.$delete(this.compra.detalle,index)
     
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
   }
  }
}
</script>