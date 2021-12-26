<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Crear Empresa</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="crear">
                <div class="row">
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>RUC</label>
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
  name : "crear-empresa",
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
  methods:{
    async crear(){
      console.log(this.empresa)
      await this.axios.post('/api/empresa',this.empresa)
        .then(response => {
          this.$router.push({name:"mostrarEmpresa"})
        })
        .catch(error=>{
          console.log(error)
        })
    }
  }
}
</script>