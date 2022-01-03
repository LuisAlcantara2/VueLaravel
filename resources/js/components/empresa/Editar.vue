<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Editar Empresa</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="actualizar">
                <div class="row">
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Documento</label>
                      <input type="text" class="form-control" v-model="empresa.emp_ruc">
                    </div>
                  </div>
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" v-model="empresa.emp_nombre">
                    </div>
                  </div>
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Dirección</label>
                      <input type="text" class="form-control" v-model="empresa.emp_direccion">
                    </div>
                  </div>
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Logo</label>
                      <input type="text" class="form-control" v-model="empresa.emp_logo">
                    </div>
                  </div>
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Correo</label>
                      <input type="text" class="form-control" v-model="empresa.emp_correo">
                    </div>
                  </div>
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Telefono</label>
                      <input type="text" class="form-control" v-model="empresa.emp_telefono">
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <router-link :to="{name:'mostrarEmpresa'}" class="btn btn-secondary" custom v-slot="{ navigate }">
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
  name : "editar-empresa",
  data(){
    return {
      empresa:{
        emp_ruc:"",
        emp_nombre:"",
        emp_logo:"",
        emp_direccion:"",
        emp_telefono:"",
        emp_correo:"",
      }
    }
  },
  mounted(){
    this.mostrarEmpresa()
  },
  methods:{
    async actualizar(){
      await this.axios.put(`/api/empresa/${this.$route.params.id}`,this.empresa)
        .then(response => {
          this.$router.push({name:"mostrarEmpresa"})
          Swal.fire('Actualizado Correctamente','','success')
        })
        .catch(error=>{
          console.log(error)
        })
    },
    async mostrarEmpresa(){
      await this.axios.get(`/api/empresa/${this.$route.params.id}`)
      .then(response=>{
        this.empresa = response.data
      })
      .catch(error=>{
        console.log(error)
      })
    }
  }
}
</script>