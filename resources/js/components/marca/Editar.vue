<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Editar Marca</h4>
            </div>
            <div class="card-body">
              <p v-if="errors.length">
                <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
                <ul>
                  <li v-for="error in errors" :key="error" class="text-danger">{{ error }}</li>
                </ul>
              </p>
              <form @submit.prevent="actualizar">
                <div class="row">
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Nombre (*)</label>
                      <input type="text" class="form-control" v-model="marca.mar_nombre">
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    <router-link :to="{name:'mostrarMarca'}" class="btn btn-secondary" custom v-slot="{ navigate }">
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
  name : "editar-marca",
  data(){
    return {
      errors:[],
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
      if(this.marca.mar_nombre)
      {
        await this.axios.put(`/api/marca/${this.$route.params.id}`,this.marca)
          .then(response => {
            this.$router.push({name:"mostrarMarca"})
            Swal.fire('Actualizado Correctamente','','success')
          })
          .catch(error=>{
            console.log(error)
          })
      }
      this.errors =[]
      if(!this.marca.mar_nombre)
      {
        this.errors.push('El nombre es obligatorio.');
      }
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