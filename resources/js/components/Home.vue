<template>
<div class="container">
<div class="row justify-content">
  <div class="col-3 mb-2">
    <label for="">Año:</label>
    <select v-model="año" class="form-control" id="añio" name="añio">
      <option v-for="anio in años" :key="anio.year" :value="anio.year">{{anio.year}}</option>
    </select>
  </div>
  <div class="col-3 mb-2">
    <label for="">Mes:</label>
    <select v-model="mes" class="form-control" id="mes" name="mes">
      <option value="1">Enero</option>
      <option value="2">Febrero</option>
      <option value="3">Marzo</option>
      <option value="4">Abril</option>
      <option value="5">Mayo</option>
      <option value="6">Junio</option>
      <option value="7">Julio</option>
      <option value="8">Agosto</option>
      <option value="9">Setiembre</option>
      <option value="10">Octubre</option>
      <option value="11">Noviembre</option>
      <option value="12">Diciembre</option>
    </select>
  </div>
  <div class="col-3 mt-4">
    <button class="btn btn-primary" @click="Actualizar"><i class="fas fa-search"></i> Filtrar</button>
  </div>
</div>
<div class="row justify-content-between">
    <div class="col-4">
        <div class="alert alert-dark">
            <h5 class="card-title">Ventas del mes</h5>
            <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
            <strong><p style="font-size: xxx-large;" class="card-text text-end">{{this.ventas}}</p></strong> 			
        </div>
    </div>
    <div class="col-4">
        <div class="alert alert-primary">
			<h5 class="card-title">Compras del mes: </h5>
            <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
            <strong><p style="font-size: xxx-large;" class="card-text text-end">{{this.compras}}</p></strong> 
        </div>
    </div>
    <div class="col-4">
        <div class="alert alert-info">
			<h5 class="card-title">Monto vendido del mes: </h5>
            <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
            <strong><p style="font-size: xxx-large;" class="card-text text-end">S/. {{this.saldo}}</p></strong>
        </div>
    </div>
</div>
<!-- <div class="small">
  <line-chart :chart-data="datacollection"></line-chart>
  <button @click="fillData()">Randomize</button>
</div> -->
</div>
</template>

<script>
import moment from "moment";
// import LineChart from './LineChart.js'
export default{
  name : "crear-venta",
  components: {
  },
  data(){
    return {
      ventas: 0,
      compras: 0,
      saldo: 0,
      años:[],
      meses:[],
      año: new Date().getFullYear(),
      mes: new Date().getMonth()+1,
      datacollection: null
    }
  },

   mounted(){    
    this.getAño()
    this.getVentas()
    this.getCompras()
    this.getSaldo()
  },
  methods:{
    Actualizar(){
      this.getVentas()
      this.getCompras()
      this.getSaldo()
    },
    async getVentas(){
      await this.axios.get('/api/getVentas',{
        params:{
          mes:this.mes,
          año:this.año,
        }
        }).then(response=>{
          this.ventas = response.data.venta
        })
        .catch(error=>{
          this.ventas = 0.00
        })
    },
    async getCompras(){
      await this.axios.get('/api/getCompras',{
        params:{
          mes:this.mes,
          año:this.año,
        }
        }).then(response=>{
          this.compras = response.data.compra
        })
        .catch(error=>{
          this.compras = 0.00
        })
    },
    async getSaldo(){
      await this.axios.get('/api/getSaldo',{
        params:{
          mes:this.mes,
          año:this.año,
        }
        }).then(response=>{
          this.saldo = response.data.saldo
        })
        .catch(error=>{
          this.saldo = 0.00
        })
    },
    async getAño(){
      await this.axios.get('/api/getAños')
        .then(response=>{
          this.años = response.data.anios
        })
        .catch(error=>{
          this.años =[]
        })
    },
    fillData () {
        this.datacollection = {
          labels: [this.getRandomInt(), this.getRandomInt()],
          datasets: [
            {
              label: 'Data One',
              backgroundColor: '#f87979',
              data: [this.getRandomInt(), this.getRandomInt()]
            }, {
              label: 'Data One',
              backgroundColor: '#f87979',
              data: [this.getRandomInt(), this.getRandomInt()]
            }
          ]
        }
      },
      getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      }
  }
}
</script>