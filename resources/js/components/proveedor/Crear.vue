<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Crear Proveedor</h4>
            </div>
            <div class="card-body">
              <p v-if="errors.length">
                <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
                <ul>
                  <li v-for="error in errors" :key="error" class="text-danger">{{ error }}</li>
                </ul>
              </p>
              <form @submit.prevent="crear">
                <div class="row">
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Documento (*)</label>
                      <div class="input-group">
                        <input type="text" class="form-control" v-model="proveedor.pvd_doc" @keypress="isDigit($event)">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" @click="Consultar" type="button"><i class="fas fa-search"></i> Consultar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Nombre (*)</label>
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
                      <input type="text" class="form-control" v-model="proveedor.pvd_telefono" @keypress="isDigit($event)">
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    <router-link :to="{name:'mostrarProveedor'}" class="btn btn-secondary" custom v-slot="{ navigate }">
                      <span @click="navigate" @keypress.enter="navigate" role="link">Atras</span>
                    </router-link>
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
  name : "crear-proveedor",
  props: ['isModal'],
  data(){
    return {
      errors:[],
      proveedor:{
        pvd_doc:"",
        pvd_nombre:"",
        pvd_direccion:"",
        pvd_telefono:"",
      }
    }
  },
  methods:{
    async crear(){
      this.errors =[]
      if(!this.proveedor.pvd_doc)
      {
        this.errors.push('El nro. de documento es obligatorio.');
      }
      else if(!(this.proveedor.pvd_doc.length==8 || this.proveedor.pvd_doc.length==11) )
      {
        this.errors.push('El documento debe ser de 8 o 11 dígitos.');
      }
      if(!this.proveedor.pvd_nombre)
      {
        this.errors.push('El nombre es obligatorio.');
      }
      if(this.proveedor.pvd_doc && this.proveedor.pvd_nombre && this.errors.length==0){
        await this.axios.post('/api/proveedor',this.proveedor)
        .then(response => {
            this.$router.push({name:"mostrarProveedor"})
            Swal.fire('Registrado Correctamente','','success')
        })
        .catch(error=>{
          console.log(error)
        })
      }
    },
    validEmail: function (email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    Consultar(){
      if(this.proveedor.pvd_doc.length==8){
      //  axios.get(API_PERU_URL+"dni/"+this.suplierData.doi+"?api_token="+API_PERU_TOKEN).then((result) => {
        axios.get("https://apiperu.dev/api/dni/"+this.proveedor.pvd_doc+"?api_token=69aff0151f9ba2dfd65f6602f5b3556a12674d365799cc919b79cd715bf160f8").then((result) => {
        if(result.data.success){
          console.log(result.data)
          this.proveedor.pvd_nombre=result.data.data.nombre_completo
          this.proveedor.pvd_direccion=result.data.data.direccion_completa
        }
        else{
            Swal.fire('Ocurrió un error','',"error")
          }
        })
      }
      else if (this.proveedor.pvd_doc.length==11){
        axios.get("https://apiperu.dev/api/ruc/"+this.proveedor.pvd_doc+"?api_token=69aff0151f9ba2dfd65f6602f5b3556a12674d365799cc919b79cd715bf160f8").then((result) => {
        if(result.data.success){
          console.log(result.data)
          this.proveedor.pvd_nombre=result.data.data.nombre_o_razon_social
          this.proveedor.pvd_direccion=result.data.data.direccion_completa
        }
        else{
            Swal.fire('Ocurrió un error','',"error")
          }
        })
      }
      else{
        Swal.fire('Nro de documento incorrecto','',"error")
      }
    },
    isDigit: function(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if ((charCode > 31 && (charCode < 48 || charCode > 57))) {
        evt.preventDefault();;
      } else {
        return true;
      }
    },
  }
}
</script>