<template>
<div class="row">
  <div class="col-12 mt-3">
    <div class="table-responsive">
        <table class="table table-border">
          <thead class="bg-primary text-white">
            <tr>
              <th>#</th>
              <th>Fecha</th>
              <th>Documento</th>
              <th>Entradas</th>
              <th>Salidas</th>
              <th>Saldo</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="mov in movimientos" :key="mov.id">
              <td>{{ mov.id}}</td>
              <td>{{ mov.krd_fecha | formatDate}}</td>
              <td>{{ mov.krd_serie}}</td>
              <td v-if="mov.krd_cantidad>0">{{ mov.krd_cantidad}}</td>
              <td v-else></td>
              <td v-if="mov.krd_cantidad<0">{{ mov.krd_cantidad}}</td>
              <td v-else></td>
              <td>{{ (Number(mov.krd_stockant)+Number(mov.krd_cantidad))}}</td>
            </tr>
          </tbody>
        </table>
    </div>
  </div>
</div>
</template>

<script>
import moment from "moment";
Vue.filter('formatDate', function(value) {
  if (value) {
    return moment(String(value)).format('DD/MM/YYYY')
  }
})
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
          console.log(response.data)
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