<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Editar Cliente</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="actualizar">
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
      await this.axios.put(`/api/cliente/${this.$route.params.id}`,this.cliente)
        .then(response => {
          this.$router.push({name:"mostrarCliente"})
          Swal.fire('Actualizado Correctamente','','success')
        })
        .catch(error=>{
          console.log(error)
        })
    },
    async mostrarCliente(){
      await this.axios.get(`/api/cliente/${this.$route.params.id}`)
      .then(response=>{
        this.cliente = response.data
      })
      .catch(error=>{
        console.log(error)
      })
    }
  }
}
</script>