<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Crear Categoria</h4>
            </div>
            <div class="card-body">
              <p v-if="errors.length">
                <b>Por favor, corrija el(los) siguiente(s) error(es):</b>
                <ul>
                  <li v-for="error in errors" :key="error" class="text-danger">{{ error }}</li>
                </ul>
              </p>
              <form @submit.prevent="crear">
                <div class="row">
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Nombre (*)</label>
                      <input type="text" class="form-control" v-model="categoria.cat_nombre">
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                    <router-link :to="{name:'mostrarCategoria'}" class="btn btn-secondary" custom v-slot="{ navigate }">
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
  name : "crear-categoria",
  data(){
    return {
      errors:[],
      categoria:{
        cat_nombre:"",
      }
    }
  },
  methods:{
    async crear(){
      if(this.categoria.cat_nombre)
      {
        await this.axios.post('/api/categoria',this.categoria)
          .then(response => {
            this.$router.push({name:"mostrarCategoria"})
            Swal.fire('Registrado Correctamente','','success')
          })
          .catch(error=>{
            console.log(error)
          })
      }
      this.errors =[]
      if(!this.categoria.cat_nombre)
      {
        this.errors.push('El nombre es obligatorio.');
      }
    }
  }
}
</script>