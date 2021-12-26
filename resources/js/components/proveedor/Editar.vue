<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Editar Proveedor</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="actualizar">
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
  name : "editar-proveedor",
  data(){
    return {
      proveedor:{
        pvd_doc:"",
        pvd_nombre:"",
        pvd_direccion:"",
        pvd_telefono:"",
      }
    }
  },
  mounted(){
    this.mostrarProveedor()
  },
  methods:{
    async actualizar(){
      await this.axios.put(`/api/proveedor/${this.$route.params.id}`,this.proveedor)
        .then(response => {
          this.$router.push({name:"mostrarProveedor"})
        })
        .catch(error=>{
          console.log(error)
        })
    },
    async mostrarProveedor(){
      await this.axios.get(`/api/proveedor/${this.$route.params.id}`)
      .then(response=>{
        this.proveedor = response.data
      })
      .catch(error=>{
        console.log(error)
      })
    }
  }
}
</script>