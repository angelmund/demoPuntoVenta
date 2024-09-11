<template>
    <div>
        <JcLoader :load="load"></JcLoader>
        <AdminTemplate :page="page" :modulo="modulo">
            <div slot="body">
                <div class="row justify-content-end">
                    <div class="col-12 col-sm-7">
                        <div class="row">
                            <div class="col-12">
                                <div class="card bg-gradient-dark">
                                    <div class="card-header bg-transparent py-2 px-3">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-12">
                                                <div class="input-group input-group-lg">
                                                    <span class="input-group-text text-white bg-transparent border-0">
                                                        <i class="ni ni-archive-2 text-lg" aria-hidden="true"></i>
                                                    </span>
                                                    <input type="text"
                                                        class="form-control bg-transparent border-0 text-white"
                                                        placeholder="Buscar..." v-model="buscar" @keyup.enter="Codebar()" />
                                                    <!---Codebar() busca por cod de barra-->
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 my-auto ms-auto">
                                                <div class="input-group input-group-lg">
                                                    <span class="input-group-text text-white bg-transparent border-0">
                                                        <i class="ni ni-box-2 text-lg" aria-hidden="true"></i>
                                                    </span>
                                                    <select name="" id=""
                                                        class="form-control bg-transparent border-0 text-white"
                                                        v-model="marca"> <!-- Manda a llamar todas las marcas-->
                                                        <option value="all" class="text-dark">
                                                            Marcas
                                                        </option>
                                                        <option class="text-dark" v-for="m in marcas" :value="m.id">{{
                                                            m.nombre }}</option>


                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-12 my-auto ms-auto">
                                                <div class="input-group input-group-lg">
                                                    <span class="input-group-text text-white bg-transparent border-0">
                                                        <i class="ni ni-folder-17 text-lg" aria-hidden="true"></i>

                                                    </span>
                                                    <select name="" id=""
                                                        class="form-control bg-transparent border-0 text-white"
                                                        v-model="categoria">
                                                        <!-- Utiliza v-model para seleccionar la categoría -->
                                                        <option value="all" class="text-dark">
                                                            Categorias
                                                        </option>
                                                        <option class="text-dark" v-for="m in categorias" :value="m.id">
                                                            {{ m.nombre }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Muestra los artículos disponbles -->
                            <div class="col-12 py-2"
                                style="min-height: 60vh; max-height: 60vh; overflow-y: scroll; overflow-x: none;">
                                <div class="row">
                                    <!--Lista de artículos-->
                                    <div class="col-md-3 col-sm-6 mb-4" v-for="m in  articulosCategoria">
                                        <!-- Componente articulo en carpeta pos-->
                                        <posArticulo :articulo="m" @AddCarrito="AddCarrito"></posArticulo>
                                    </div><!--Termina Lista de artículos-->
                                </div>
                            </div> <!-- Termina  Muestra los artículos disponbles -->


                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="card card-pricing">
                            <div class="card-header bg-gradient-dark text-center pt-4 pb-5 position-relative">
                                <div class="z-index-1 position-relative">
                                    <h1 class="text-white mt-2 mb-0"><small></small>$ {{ Number(totalCarrito).toFixed(2) }}
                                    </h1>
                                    <h6 class="text-white">Total</h6>
                                </div>
                            </div>
                            <div class="position-relative mt-n5" style="height: 50px">
                                <div class="position-absolute w-100">
                                    <svg class="waves waves-sm" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40"
                                        preserveAspectRatio="none" shape-rendering="auto">
                                        <defs>
                                            <path id="card-wave"
                                                d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
                                            </path>
                                        </defs>
                                        <g class="mov ing-waves">
                                            <use xlink:href="#card-wave" x="48" y="-1" fill="rgba(255,255,255,0.30"></use>
                                            <use xlink:href="#card-wave" x="48" y="3" fill="rgba(255,255,255,0.35)"></use>
                                            <use xlink:href="#card-wave" x="48" y="5" fill="rgba(255,255,255,0.25)"></use>
                                            <use xlink:href="#card-wave" x="48" y="8" fill="rgba(255,255,255,0.20)"></use>
                                            <use xlink:href="#card-wave" x="48" y="13" fill="rgba(255,255,255,0.15)"></use>
                                            <use xlink:href="#card-wave" x="48" y="16" fill="rgba(255,255,255,0.99)"></use>
                                        </g>
                                    </svg>
                                </div>
                            </div>
                            <div class="card-body text-center p-3">
                                <div class="d-flex align-items-center px-2">
                                    <h6>CARRITO</h6>
                                    <button type="button"
                                        class="btn btn-icon-only btn-rounded btn-outline-dark mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto"
                                        data-bs-toggle="tooltip" data-bs-placement="bottom" @click="Clean()">
                                        <i class="fas fa-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="table-responsive p-0" style="min-height: 30vh">
                                    <table class="table align-items-center justify-content-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-start">
                                                    Artículo
                                                </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-start">
                                                    Cantidad
                                                </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-start">
                                                    Total
                                                </th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(m, i) in carrito">
                                                <td class="text-start">
                                                    <p class="text-xxs font-weight-bold mb-0 text-start">
                                                        {{ m.articulo.nombre }}
                                                    </p>
                                                </td>
                                                <td class="text-start">
                                                    <p class="text-xxs font-weight-bold mb-0 text-start">
                                                        {{ m.cantidad }}
                                                    </p>
                                                </td>
                                                <td class="text-start">
                                                    <p class="text-xxs font-weight-bold mb-0 text-start">
                                                        {{ Number(m.cantidad * m.precio).toFixed(2) }}
                                                    </p>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-sm">
                                                        <button class="btn btn-outline-primary mb-0 btn-sm" type="button"
                                                            @click="[modalEdit = true, item = m]">
                                                            <i class="fas fa-pen"></i>
                                                        </button>
                                                        <button class="btn btn-outline-danger mb-0 btn-sm" type="button"
                                                            @click="EliminarItem(i)">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="javascript:void(0);" class="btn bg-gradient-dark w-100 mt-4 mb-0" @click="Save()">
                                    <i class="fas fa-save mx-2"></i> GUARDAR
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" :class="modalEdit ? 'showModal' : ''" id="AjusteModal" tabindex="-1"
                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Editar artículo
                                    </h5>
                                    <button type="button" class="btn-close text-dark" @click="modalEdit = false"
                                        data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group has-success">
                                                <label for="">Articulo</label>
                                                <input type="text" placeholder="" disabled class="form-control"
                                                    :value="item.articulo.nombre" />
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group has-success">
                                                <label for="">Precio</label>
                                                <input type="text" placeholder="" class="form-control"
                                                    v-model.number="item.precio" />
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="form-group has-success">
                                                <label for="">Cantidad</label>
                                                <input type="text" placeholder="" class="form-control"
                                                    v-model.number="item.cantidad" />
                                            </div>
                                        </div>



                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" @click="modalEdit = false" class="btn bg-gradient-secondary w-100"
                                        data-bs-dismiss="modal">
                                        Cerrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AdminTemplate>
    </div>
</template>
  
<script>

export default {
    head() {
        return {
            title: this.modulo,
        };
    },

    data() {
        return {
            modulo: "Nueva compra",
            page: "Compras",
            buscar: "",
            marca: "all",
            categoria: "all",
            load: true,
            modalEdit: false,
            articulos: [],
            marcas: [],
            categorias: [],
            carrito: [],
            item: {
                articulo: {
                    nombre: ''
                },
                cantidad: 0,
                precio: 0,
            }

        };
    },
    computed: {
        //Esta función indica que filtre el nombre de un articulo cuando se escribe en el buscador
        articulosFilter() {
            let buscar = this.buscar
            if (!buscar == '') {
                return this.articulos.filter((a) => {
                    let nombre = a.nombre !== null ? a.nombre : '' //si no encuentra el mismo nombre, no muestra nada
                    let barra = a.barra !== null ? a.barra : '' //si no encuentra el mismo nombre, no muestra nada
                    return nombre.toLowerCase().indexOf(buscar.toLowerCase()) !== -1 || barra.toLowerCase().indexOf(buscar.toLowerCase()) !== -1//devuelve el articulo por nombre o por barra
                })
            }
            return this.articulos // terminaEsta función indica que filtre el nombre de un articulo cuando se escribe en el buscador
        },
        articulosMarca() {
            let marca = this.marca
            if (marca != 'all') { //si marca es igual me muestra 
                return this.articulosFilter.filter((a) => {

                    return a.marca_id == marca; // caso contarrio devuelve el articulo en caso de que sea diferente de-1
                })
            }
            return this.articulosFilter // terminaEsta función indica que filtre la marca de un articulo cuando se escribe en el buscador

        }, //termina Esta función indica que filtre el nombre de un articulo cuando se escribe en el buscador
        //termina Esta función indica que filtre el nombre de la categoria 
        articulosCategoria() {
            let categoria = this.categoria
            if (categoria != 'all') { //si mcategoria es igual me muestra 
                return this.articulosMarca.filter((a) => {

                    return a.categoria_id == categoria; // caso contarrio devuelve el articulo en caso de que sea diferente de-1
                })
            }
            return this.articulosMarca // terminaEsta función indica que filtre la categoria de un articulo cuando se escribe en el buscador

        }, //termina Esta función indica que filtre el nombre de la categoria 
        //función para sumar los items y aparezca el total 
        totalCarrito() {
            return this.carrito.reduce((a, b) => a + (b.cantidad * b.precio), 0)
        }// Termina función para sumar los items y aparezca el total

    },
    methods: {
        async GET_DATA(path) { //se manda el modelo ya sea marcas, modelo, etc
            const res = await this.$api.$get(path); //hace consulta a esa api
            return res;
        },
        async Datos() {
            //se mete en un try catch por algún error 
            try {
                //llama al o los registros 
                await Promise.all([this.GET_DATA('marcas'), this.GET_DATA('categorias'), this.GET_DATA('articulos')]).then((v) => {
                    this.marcas = v[0] //obtiene el registro de marcas se refiere a la lista de datos
                    this.categorias = v[1] //obtiene el registro de categoria se refiere a la lista de datos
                    this.articulos = v[2] //obtiene el registro de articulos se refiere a la lista de datos
                });
            }
            catch (e) {
                console.log(e); //muestra el mensaje de error
            }

        },
        //función definida en articulo, hace que se agreguen items al carrito
        AddCarrito(articulo) {
            //Hace que no se duplique el artículo en el carrito
            let id = articulo.id
            let buscarRegistro = this.carrito.filter((i) => i.articulo.id == id) //compara el id del artículo para evitar duplicar
            if (buscarRegistro.length > 0) {
                //si buscarRegistro es mayor a 0, no hace nada
                let indice = this.carrito.findIndex((i) => i.articulo.id == id)
                //let item = this.carrito[indice]
                this.carrito[indice].cantidad += 1; //suma la cantidad de items
            } else { //en caso contrario, captura el artículo y no lo duplica
                const item = {
                    articulo: articulo,
                    cantidad: 1,
                    precio: articulo.compra, //captura el precio de compra
                }
                this.carrito.push(item)
            }


        },  // termina función definida en articulo, hace que se agreguen items al carrito
        EliminarItem(i) { //recibe un índice, i índica que es un índice 
            this.carrito.splice(i, 1)
        },
        Codebar() {
            let code = this.buscar
            let buscarRegistro = this.articulosCategoria.filter((i) => i.barra == code) //compara el id del artículo para evitar duplicar
            if (buscarRegistro.length > 0) {
                this.AddCarrito(buscarRegistro[0])
                this.buscar = ''
            }
        },
        async Save() { //Hace que se guarden los datos 

            this.load = true
            let self = this
            // Verificar si el carrito está vacío
            if (this.carrito.length === 0) {
                this.$swal.fire('Debe agregar artículos para la compra', '', 'error');
                this.load = false;
                return; // Salir de la función si no hay artículos
            }
            try {
                const operacion = {
                    total: this.totalCarrito,
                    tipo: 1,
                    motivo: '',
                    proveedor: 'Publico general',
                    carrito: this.carrito
                }

                // console.log(res);

                // Mostrar SweetAlert2 para confirmar la acción
                const result = await this.$swal.fire({
                    title: '¿Seguro que quiere realizar la opración?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    denyButtonText: `Cancelar`,
                });

                //este if, hace que si se presiona guardar, se guarde, en caso de cancelar, no se guarda
                if (result.isConfirmed) {
                    const res = await this.$api.$post('compras', operacion);
                    this.$swal.fire('Guardado con éxito!', '', 'success');
                    //console.log(res);
                    self.Clean()

                } else if (result.isDenied) {
                    this.$swal.fire('Cambios descartados', '', 'info'); // Mostramos un mensaje informativo
                }

            } catch (e) {
                console.log(e);
            } finally {
                this.load = false;
            }
        },
        Clean() {
            this.carrito = []
        },
    },
    mounted() {

        this.$nextTick(async () => {
            //se mete en un try catch por algún error 
            try {
                await this.Datos()
            }
            catch (e) {
                console.log(e); //muestra el mensaje de error
            } finally {
                this.load = false//carga todos los datos del sistema y muestra una vez que termino todo
            }

        });
    },
};
</script>
<style>
.showModal {
    visibility: visible;
    display: block;
    opacity: 1 !important;
}
</style>
  