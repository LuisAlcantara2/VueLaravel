<template>
<div class="row">
  <div class="col-12 mt-3">
    <div class="table-responsive">
        <table class="table table-border">
          <thead class="bg-primary text-white">
            <tr>
              <th>#</th>
              <th>Fecha</th>
              <th>Cantidad</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="mov in movimientos" :key="mov.id">
              <td>{{ mov.id}}</td>
              <td>{{ mov.krd_fecha | formatDate}}</td>
              <td>{{ mov.krd_cantidad}}</td>
            </tr>
          </tbody>
        </table>
    </div>
  </div>
</div>
</template>

<script>
export default{
  name:"movimiento",
  data(){
    return{
      movimientos:[]
    }
  },
  mounted(){
    this.mostrarMovimientos()
  },
  methods: {
    async mostrarMovimientos(){
      await this.axios.get(`/api/movimiento/${this.$route.params.id}`)
        .then(response=>{
          this.movimientos = response.data
        })
        .catch(error=>{
          console.log('error:',error)
          this.movimientos = []
        })
    },
  },
}

</script>