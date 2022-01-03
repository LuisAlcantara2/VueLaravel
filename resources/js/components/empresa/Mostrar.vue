<template>
<div class="container">
  <div class="row">
    <div>
      <router-link to="/crearEmpresa" class="btn btn-success" custom v-slot="{ navigate }">
        <span @click="navigate" @keypress.enter="navigate" role="link"> <i class="fas fa-plus-circle"></i>  Nuevo</span>
      </router-link>
    </div>
    <div class="col-12"> 
      <div class="table-responsive">
        <table class="table table-border">
          <thead class="bg-primary text-white">
            <tr>
              <th>#</th>
              <th>Empresa</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="empresa in empresaes" :key="empresa.id">
              <td>{{ empresa.id}}</td>
              <td>{{ empresa.emp_nombre}}</td>
              <td>
                <router-link :to="{name:'editarEmpresa', params: { id: empresa.id }}" class="btn btn-info" custom v-slot="{ navigate }">
                  <span @click="navigate" @keypress.enter="navigate" role="link">Editar</span>
                </router-link>
                <a type="button" @click="borrarEmpresa(empresa.id)" class="btn btn-danger"> Eliminar </a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</template>
<script>
export default{
  name:"empresaes",
  data(){
    return{
      empresaes:[]
    }
  },
  mounted(){
    this.mostrarEmpresas()
  },
  methods: {
    async mostrarEmpresas(){
      await this.axios.get('api/empresa')
        .then(response=>{
          this.empresaes = response.data
        })
        .catch(error=>{
          this.empresaes = []
        })
    },
    borrarEmpresa(id){
      Swal.fire({
        title:'¿Confirma eliminar el registro?',
        confirmButtonText:'Confirmar',
        showCancelButton: true
      }).then((result)=>{
        if(result.isConfirmed){
          this.axios.delete(`/api/empresa/${id}`).then(response=>{this.mostrarEmpresas()}).catch(error=>{console.log(error)});
          Swal.fire('Eliminado','','success')
        }else if(result.isDenied){}
      });
    }
  },
}
</script>