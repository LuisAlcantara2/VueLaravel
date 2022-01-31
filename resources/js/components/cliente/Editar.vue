<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Editar Cliente</h4>
            </div>
            <div class="card-body">
              <p v-if="errors.length">
                <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
                <ul>
                  <li v-for="error in errors" :key="error" class="text-danger">{{ error }}</li>
                </ul>
              </p>
              <form @submit.prevent="actualizar">
                <div class="row">
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Documento (*)</label>
                      <div class="input-group">
                        <input type="text" class="form-control" v-model="cliente.cli_doc" @keypress="isDigit($event)">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary" @click="Consultar" type="button"><i class="fas fa-search"></i> Consultar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Nombre (*)</label>
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
                      <input type="text" class="form-control" v-model="cliente.cli_telefono" @keypress="isDigit($event)">
                    </div>
                  </div>
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Correo</label>
                      <input type="text" class="form-control" v-model="cliente.cli_correo">
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    <router-link :to="{name:'mostrarCliente'}" class="btn btn-secondary" custom v-slot="{ navigate }">
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
  name : "editar-cliente",
  data(){
    return {
      errors:[],
      cliente:{
        cli_doc:"",
        cli_nombre:"",
        cli_direccion:"",
        cli_telefono:"",
        cli_correo:"",
      }
    }
  },
  mounted(){
    this.mostrarCliente()
  },
  methods:{
    async actualizar(){
      this.errors =[]
      if(!this.cliente.cli_doc)
      {
        this.errors.push('El nro. de documento es obligatorio.');
      }
      else if(!(this.cliente.cli_doc.length==8 || this.cliente.cli_doc.length==11) )
      {
        this.errors.push('El documento debe ser de 8 o 11 dígitos.');
      }
      if(!this.cliente.cli_nombre)
      {
        this.errors.push('El nombre es obligatorio.');
      }
      if(!this.validEmail(this.cliente.cli_correo) && this.cliente.cli_correo) {
        this.errors.push('El correo electrónico debe ser válido.');
      }
      if(this.cliente.cli_doc && this.cliente.cli_nombre && this.errors.length==0)
      {
        await this.axios.put(`/api/cliente/${this.$route.params.id}`,this.cliente)
          .then(response => {
            this.$router.push({name:"mostrarCliente"})
            Swal.fire('Actualizado Correctamente','','success')
          })
          .catch(error=>{
            console.log(error)
          })
      }
    },
    async mostrarCliente(){
      await this.axios.get(`/api/cliente/${this.$route.params.id}`)
      .then(response=>{
        this.cliente = response.data
      })
      .catch(error=>{
        console.log(error)
      })
    },
    Consultar(){
      if(this.cliente.cli_doc.length==8){
      //  axios.get(API_PERU_URL+"dni/"+this.suplierData.doi+"?api_token="+API_PERU_TOKEN).then((result) => {
        axios.get("https://apiperu.dev/api/dni/"+this.cliente.cli_doc+"?api_token=69aff0151f9ba2dfd65f6602f5b3556a12674d365799cc919b79cd715bf160f8").then((result) => {
        if(result.data.success){
          console.log(result.data)
          this.cliente.cli_nombre=result.data.data.nombre_completo
          this.cliente.cli_direccion=result.data.data.direccion_completa
        }
        else{
            Swal.fire('Ocurrió un error','',"error")
          }
        })
      }
      else if (this.cliente.cli_doc.length==11){
        axios.get("https://apiperu.dev/api/ruc/"+this.cliente.cli_doc+"?api_token=69aff0151f9ba2dfd65f6602f5b3556a12674d365799cc919b79cd715bf160f8").then((result) => {
        if(result.data.success){
          console.log(result.data)
          this.cliente.cli_nombre=result.data.data.nombre_o_razon_social
          this.cliente.cli_direccion=result.data.data.direccion_completa
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
    validEmail: function (email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },  
  }
}
</script>