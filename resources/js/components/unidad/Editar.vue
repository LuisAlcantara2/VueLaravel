<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Editar Unidad</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="actualizar">
                <div class="row">
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" v-model="unidad.uni_nombre">
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
  name : "editar-unidad",
  data(){
    return {
      unidad:{
        uni_nombre:"",
      }
    }
  },
  mounted(){
    this.mostrarUnidad()
  },
  methods:{
    async actualizar(){
      await this.axios.put(`/api/unidad/${this.$route.params.id}`,this.unidad)
        .then(response => {
          this.$router.push({name:"mostrarUnidad"})
        })
        .catch(error=>{
          console.log(error)
        })
    },
    async mostrarUnidad(){
      await this.axios.get(`/api/unidad/${this.$route.params.id}`)
      .then(response=>{
        this.unidad = response.data
      })
      .catch(error=>{
        console.log(error)
      })
    }
  }
}
</script>