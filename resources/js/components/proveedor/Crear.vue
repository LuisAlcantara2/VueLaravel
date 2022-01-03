<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Crear Proveedor</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="crear">
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
      await this.axios.post('/api/proveedor',this.proveedor)
        .then(response => {
            this.$router.push({name:"mostrarProveedor"})
            Swal.fire('Registrado Correctamente','','success')
        })
        .catch(error=>{
          console.log(error)
        })
    },
  }
}
</script>