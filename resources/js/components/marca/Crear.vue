<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Crear Marca</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="crear">
                <div class="row">
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" v-model="marca.mar_nombre">
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
  name : "crear-marca",
  data(){
    return {
      marca:{
        mar_nombre:"",
        // mar_estado:1,
      }
    }
  },
  methods:{
    async crear(){
      console.log('mar',this.marca)
      await this.axios.post('/api/marca',this.marca)
        .then(response => {
          this.$router.push({name:"mostrarMarca"})
          Swal.fire('Registrado Correctamente','','success')
        })
        .catch(error=>{
          console.log(error)
        })
    }
  }
}
</script>