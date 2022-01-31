<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Crear Serie</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="crear">
                <div class="row">
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Serie</label>
                      <input type="text" class="form-control" v-model="serie.ser_serie">
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
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
  name : "crear-serie",
  data(){
    return {
      serie:{
        ser_serie:"",
        ser_corre:1,
      }
    }
  },
  methods:{
    async crear(){
      if(this.serie.ser_serie.trim()=="")
      {
        Swal.fire('Ingrese serie','','error')
      }
      else{
        await this.axios.post('/api/serie',this.serie)
          .then(response => {
            this.$router.push({name:"mostrarSerie"})
            Swal.fire('Registrado Correctamente','','success')
          })
          .catch(error=>{
            console.log(error)
          })
      }
    }
  }
}
</script>