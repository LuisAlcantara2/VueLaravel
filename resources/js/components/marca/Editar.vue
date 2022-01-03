<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Editar Marca</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="actualizar">
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
  name : "editar-marca",
  data(){
    return {
      marca:{
        mar_nombre:"",
        // mar_estado:1,
      }
    }
  },
  mounted(){
    this.mostrarMarca()
  },
  methods:{
    async actualizar(){
      await this.axios.put(`/api/marca/${this.$route.params.id}`,this.marca)
        .then(response => {
          this.$router.push({name:"mostrarMarca"})
          Swal.fire('Actualizado Correctamente','','success')
        })
        .catch(error=>{
          console.log(error)
        })
    },
    async mostrarMarca(){
      await this.axios.get(`/api/marca/${this.$route.params.id}`)
      .then(response=>{
        this.marca = response.data
      })
      .catch(error=>{
        console.log(error)
      })
    }
  }
}
</script>