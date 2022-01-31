<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Editar Serie</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="actualizar">
                <div class="row">
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Serie</label>
                      <input type="text" class="form-control" v-model="serie.ser_serie">
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <router-link :to="{name:'mostrarSerie'}" class="btn btn-secondary" custom v-slot="{ navigate }">
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
  name : "editar-serie",
  data(){
    return {
      serie:{
        ser_serie:"",
        ser_corre:0,
      }
    }
  },
  mounted(){
    this.mostrarSerie()
  },
  methods:{
    async actualizar(){    
      await this.axios.put(`/api/serie/${this.$route.params.id}`,this.serie)
        .then(response => {
          this.$router.push({name:"mostrarSerie"})
          Swal.fire('Actualizado Correctamente','','success')
        })
        .catch(error=>{
          console.log(error)
        })
    },
    async mostrarSerie(){
      await this.axios.get(`/api/serie/${this.$route.params.id}`)
      .then(response=>{
        this.serie = response.data
      })
      .catch(error=>{
        console.log(error)
      })
    }
  }
}
</script>