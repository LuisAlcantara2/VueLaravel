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
   <div class="row justify-content">
     <div class="col-6">
       <apexchart width="100%" type="bar" ref="realtimeChart" :options="chartOptions" :series="series"></apexchart>
     </div>
     <div class="col-5">
       <apexchart type="donut" width="100%" ref="realtimeChart2" :options="chartOptions2" :series="series2"></apexchart>
     </div>
   </div>
</div>
</template>

<script>

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
      reporte:[],
      año: new Date().getFullYear(),
      mes: new Date().getMonth()+1,
      chartOptions: {
        chart: {
          id: 'vuechart-example'
        },
        xaxis: {
          categories: []
        }
      },
      series: [{
        name:'ventas',
        data:[]
      }],

      // da
      series2: [1, 1, 1, 1, 1],
      chartOptions2: {
        chart: {
          type: 'donut',
          selection: {
            enabled: true
          },
          toolbar:{
            show: true
          }
        },
        plotOptions: {
          pie: {
            donut: {
              labels: {
                show: true,
                total: {
                  show: true,
                  label: 'Total',
                  color: '#373d3f',
                  formatter: function (w) {
                    return w.globals.seriesTotals.reduce((a, b) => {
                      return a + b
                    }, 0)
                  }
                }
              }
            }
          }
        },
      dataLabels: {
        enabled: false,//NOSE VEAN NUMEROS
        formatter: function (val, opts) {
            return opts.w.config.series[opts.seriesIndex]
        },
      },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            formatter: function (val) {
              return val
            },
            legend: {
              position: 'bottom',
              dataLabels:{
                formatter: function (val, opts) {
                    return opts.w.config.series[opts.seriesIndex]
                },
              }
            }
          }
        }]
      },
    }
  },

   mounted(){    
    this.getAño()
    this.getVentas()
    this.getCompras()
    this.getSaldo()
    this.getReporte1()
    this.getReporte2()
  },
  methods:{
    Actualizar(){
      this.getVentas()
      this.getCompras()
      this.getSaldo()
      this.getReporte2()
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
    async getReporte1(){
      this.series[0].data=[]
      this.chartOptions.xaxis.categories=[]
      let cat=[]
      await this.axios.get('/api/reporteVenta')
        .then(response=>{
          this.reporte = response.data.venta
          this.reporte.forEach(element => {
            cat.push(element.name)
            this.series[0].data.push(element.data)
          });
          this.$refs.realtimeChart.updateSeries([{
            data: this.series[0].data,
          }], false, true);
          this.chartOptions = {...this.chartOptions, ...{
              xaxis: {
                  categories:cat
              }
            }}
        })
        .catch(error=>{
          this.años =[]
        })
    },
    async getReporte2(){
      this.series2=[]
      this.chartOptions2.labels=[]
      let cat=[]
      await this.axios.get('/api/reporteVenta2',{
        params:{
          mes:this.mes,
          año:this.año,
        }}).then(response=>{
          this.reporte = response.data.productos
          this.reporte.forEach(element => {
            cat.push(element.nombre)
            this.series2.push(Number(element.cantidad))
          });
          this.chartOptions2 = {...this.chartOptions, ...{
              labels:cat
            }}
        })
        .catch(error=>{
        })
    },
  }
}
</script>
