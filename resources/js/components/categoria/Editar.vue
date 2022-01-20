<template>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Editar Categoria</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="actualizar">
                <div class="row">
                  <div class="col-12 mb-2">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" v-model="categoria.cat_nombre">
                    </div>
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-trash"></i> Guardar</button>
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
  name : "editar-categoria",
  data(){
    return {
      categoria:{
        cat_nombre:"",
      }
    }
  },
  mounted(){
    this.mostrarCategoria()
  },
  methods:{
    async actualizar(){
      await this.axios.put(`/api/categoria/${this.$route.params.id}`,this.categoria)
        .then(response => {
          this.$router.push({name:"mostrarCategoria"})
          Swal.fire('Actualizado Correctamente','','success')
        })
        .catch(error=>{
          console.log(error)
        })
    },
    async mostrarCategoria(){
      await this.axios.get(`/api/categoria/${this.$route.params.id}`)
      .then(response=>{
        this.categoria = response.data
      })
      .catch(error=>{
        console.log(error)
      })
    }
  }
}
</script>