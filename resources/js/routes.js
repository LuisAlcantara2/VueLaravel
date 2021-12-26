const Home = ()=>import('./components/Home.vue')

const MarcaMostrar = ()=> import('./components/marca/Mostrar.vue')
const MarcaCrear = ()=> import('./components/marca/Crear.vue')
const MarcaEditar = ()=> import('./components/marca/Editar.vue')

const CategoriaMostrar = ()=> import('./components/categoria/Mostrar.vue')
const CategoriaCrear = ()=> import('./components/categoria/Crear.vue')
const CategoriaEditar = ()=> import('./components/categoria/Editar.vue')

const UnidadMostrar = ()=> import('./components/unidad/Mostrar.vue')
const UnidadCrear = ()=> import('./components/unidad/Crear.vue')
const UnidadEditar = ()=> import('./components/unidad/Editar.vue')

const ClienteMostrar = ()=> import('./components/cliente/Mostrar.vue')
const ClienteCrear = ()=> import('./components/cliente/Crear.vue')
const ClienteEditar = ()=> import('./components/cliente/Editar.vue')

const ProveedorMostrar = ()=> import('./components/proveedor/Mostrar.vue')
const ProveedorCrear = ()=> import('./components/proveedor/Crear.vue')
const ProveedorEditar = ()=> import('./components/proveedor/Editar.vue')

const EmpresaMostrar = ()=> import('./components/empresa/Mostrar.vue')
const EmpresaCrear = ()=> import('./components/empresa/Crear.vue')
const EmpresaEditar = ()=> import('./components/empresa/Editar.vue')

const ProductoMostrar = ()=> import('./components/producto/Mostrar.vue')
const ProductoCrear = ()=> import('./components/producto/Crear.vue')
const ProductoEditar = ()=> import('./components/producto/Editar.vue')

const CompraMostrar = ()=> import('./components/compra/Mostrar.vue')
const CompraCrear = ()=> import('./components/compra/Crear.vue')
const CompraEditar = ()=> import('./components/compra/Editar.vue')


export const routes =[
    {
        name :'home',
        path: '/',
        component:Home
    },
    {
        name :'mostrarMarca',
        path: '/marcas',
        component:MarcaMostrar
    },
    {
        name :'crearMarca',
        path: '/crear',
        component:MarcaCrear
    },
    {
        name :'editarMarca',
        path: '/editar/:id',
        component:MarcaEditar
    },
    {
        name :'mostrarCategoria',
        path: '/categorias',
        component:CategoriaMostrar
    },
    {
        name :'crearCategoria',
        path: '/crearCategoria',
        component:CategoriaCrear
    },
    {
        name :'editarCategoria',
        path: '/editarCategoria/:id',
        component:CategoriaEditar
    },
    {
        name :'mostrarUnidad',
        path: '/unidades',
        component:UnidadMostrar
    },
    {
        name :'crearUnidad',
        path: '/crearUnidad',
        component:UnidadCrear
    },
    {
        name :'editarUnidad',
        path: '/editarUnidad/:id',
        component:UnidadEditar
    },
    {
        name :'mostrarCliente',
        path: '/clientes',
        component:ClienteMostrar
    },
    {
        name :'crearCliente',
        path: '/crearCliente',
        component:ClienteCrear
    },
    {
        name :'editarCliente',
        path: '/editarCliente/:id',
        component:ClienteEditar
    },
    {
        name :'mostrarProveedor',
        path: '/proveedores',
        component:ProveedorMostrar
    },
    {
        name :'crearProveedor',
        path: '/crearProveedor',
        component:ProveedorCrear
    },
    {
        name :'editarProveedor',
        path: '/editarProveedor/:id',
        component:ProveedorEditar
    },
    {
        name :'mostrarEmpresa',
        path: '/empresas',
        component:EmpresaMostrar
    },
    {
        name :'crearEmpresa',
        path: '/crearEmpresa',
        component:EmpresaCrear
    },
    {
        name :'editarEmpresa',
        path: '/editarEmpresa/:id',
        component:EmpresaEditar
    },
    {
        name :'mostrarProducto',
        path: '/productos',
        component:ProductoMostrar
    },
    {
        name :'crearProducto',
        path: '/crearProducto',
        component:ProductoCrear
    },
    {
        name :'editarProducto',
        path: '/editarProducto/:id',
        component:ProductoEditar
    },
    {
        name :'mostrarCompra',
        path: '/compras',
        component:CompraMostrar
    },
    {
        name :'crearCompra',
        path: '/crearCompra',
        component:CompraCrear
    },
    {
        name :'editarCompra',
        path: '/editarCompra/:id',
        component:CompraEditar
    },
]