<script>
import Vue from 'vue'
import BootstrapSidebar from 'vue-bootstrap-sidebar'
 
export default Vue.extend({
  name: 'App',
  components: {
    BootstrapSidebar
  },
  data () {
    return {
      initialShow: true,
      header: '<h3>Kristel</h3>',
      links: [
        { name: 'Inicio', href: { name: 'home' }},
        {
          name: 'Ventas',
          children: [
            {
              name: 'Lista',
              href: {
                name: ''
              },
            },
            {
              name: 'Clientes',
              href: {
                name: 'mostrarCliente'
              },
            }
          ]
        },
        {
          name: 'Compras',
          children: [
            {
              name: 'Lista',
              href: {
                name: 'mostrarCompra'
              },
            },
            {
              name: 'Proveedores',
              href: {
                name: 'mostrarProveedor'
              },
            }
          ]
        },
        {
          name: 'Almacen',
          children: [
            {
              name: 'Categorias',
              href: {
                name: 'mostrarCategoria'
              },
            },
            {
              name: 'Unidades',
              href: {
                name: 'mostrarUnidad'
              },
            },
            {
              name: 'Marcas',
              href: {
                name: 'mostrarMarca'
              },
            },
            {
              name: 'Productos',
              href: {
                name: 'mostrarProducto'
              },
            }
          ]
        },
        {
          name: 'Configuracion',
          children: [
            {
              name: 'Empresa',
              href: {
                name: 'mostrarEmpresa'
              },
            }
          ]
        },
      ]
    }
  },
  methods: {
    onSidebarChanged () {
    }
  }
})
</script> 
 
<template>
  <div id="App">
    <BootstrapSidebar
      :initial-show="initialShow"
      :links="links"
      :header="header"
      @sidebarChanged="onSidebarChanged"
    >
      <template v-slot:navbar>
        <b-navbar
          id="mainNavbar"
          toggleable="lg"
          type="light"
          variant="light"
          fixed="top"
        >
          <b-navbar-nav>
            <b-nav-item>
              
            </b-nav-item>
          </b-navbar-nav>
        </b-navbar>
      </template>
 
      <template v-slot:content>
        <b-container style="margin-top: 56px">
          <router-view />
        </b-container>
      </template>
    </BootstrapSidebar>
  </div>
</template>
 
<style lang="scss">
  @import 'node_modules/vue-bootstrap-sidebar/src/scss/default-theme.scss';
</style> 