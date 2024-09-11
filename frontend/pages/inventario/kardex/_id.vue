<template>
    <div>
        <JcLoader :load="load"></JcLoader>
        <AdminTemplate :page="page" :modulo="modulo">
            <div slot="body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-lg-flex">
                                    <div>
                                        <h5 class="mb-0">Kardex de artículo</h5>
                                    </div>
                                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                                        <div class="ms-auto my-auto">
                                            <button @click="$router.back()" class="btn bg-gradient-info btn-sm mb-0">
                                                <i class="ni ni-bold-left"></i> Regresar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-lg-5 mx-auto">
                                        <h3>{{ model.nombre }}</h3>
                                        <div class="rating">

                                            <i class="fas fa-barcode" aria-hidden="true"></i>
                                            {{ model.barra }}

                                            <i class="fas fa-boxes" aria-hidden="true"></i>
                                            {{ model.categoria.nombre }}
                                            <i class="fas fa-bookmark" aria-hidden="true"></i>
                                            {{ model.marca.nombre }}
                                        </div>
                                        <br />
                                        <div class="d-flex justify-content-between">
                                            <div class="mx-1">
                                                <h6 class="mb-0 mt-3">Precio Compra</h6>
                                                <h5>$ {{ Number(model.compra).toFixed(2) }}</h5>
                                            </div>
                                            <div class="mx-1">
                                                <h6 class="mb-0 mt-3">Precio Venta</h6>
                                                <h5>$ {{ Number(model.venta).toFixed(2) }}</h5>
                                            </div>
                                            <div class="mx-1">
                                                <h6 class="mb-0 mt-3">Ganancia Unitaria</h6>
                                                <h5>$ {{ Number(model.venta - model.compra).toFixed(2) }}</h5>
                                            </div>
                                        </div>
                                        <span class="badge"
                                            :class="[model.stock <= 10? 'badge-danger' : 'badge-success']"><i
                                                class="fas fa-archive" aria-hidden="true"></i> {{ model.stock }} en
                                            Stock</span>
                                        <br />
                                        <div class="d-flex justify-content-between">
                                            <div class="mx-1">
                                                <h6 class="mb-0 mt-3">Inversion</h6>
                                                <h5>$ {{ Number(model.stock * model.compra) }}</h5>
                                            </div>
                                            <div class="mx-1">
                                                <h6 class="mb-0 mt-3">Valorizado</h6>
                                                <h5>$ {{ Number(model.stock * model.venta) }}</h5>
                                            </div>
                                            <div class="mx-1">
                                                <h6 class="mb-0 mt-3">Ganancia</h6>
                                                <h5>$ {{ model.valorizado - model.inversion }}</h5>
                                                <!-- Hace que se muestre la ganancia, la lógica está en el controlador inventario -->
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-lg-12">
                                                <button class="btn bg-gradient-primary mb-0 mt-lg-auto w-100" type="button"
                                                    name="button" data-bs-toggle="modal" data-bs-target="#AjusteModal">
                                                    <i class="fas fa-cog"></i>
                                                    Ajustar Stock
                                                </button>
                                                <div class="modal fade" id="AjusteModal" tabindex="-1" role="dialog"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">
                                                                    Nuevo Ajuste
                                                                </h5>
                                                                <button type="button" class="btn-close text-dark"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <div class="form-group has-success">
                                                                            <label for="">Cantidad</label>
                                                                            <input type="text" placeholder=""
                                                                                class="form-control"
                                                                                v-model.number="inventario.cantidad" />
                                                                            <!--inventario.cantidad Hace que haceda al objeto inventario a la propiedad cantidad-->
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group has-success">
                                                                            <label for="">Tipo de ajuste</label>
                                                                            <select name="" id="" class="form-control"
                                                                                v-model.number="inventario.tipo"><!--inventario.cantidad Hace que haceda al objeto inventario a la propiedad cantidad-->
                                                                                <option value="1">ENTRADA</option>
                                                                                <option value="2">SALIDA</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group has-success">
                                                                            <label for="">Precio Compra</label>
                                                                            <input type="text" placeholder=""
                                                                                class="form-control"
                                                                                v-model.number="model.compra" />
                                                                            <!--precio.compra Hace que haceda al objeto model a la propiedad compra-->
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group has-success">
                                                                            <label for="">Precio Venta</label>
                                                                            <input type="text" placeholder=""
                                                                                class="form-control"
                                                                                v-model.number="model.venta" />
                                                                            <!--model.venta Hace que haceda al objeto model a la propiedad venta-->
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group has-success">
                                                                            <label for="">Motivo</label>
                                                                            <input type="text" placeholder=""
                                                                                class="form-control"
                                                                                v-model="inventario.motivo" />
                                                                            <!-- Hacede a inventrio a la propiedad motivo-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn bg-gradient-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Cancelar
                                                                </button>
                                                                <button type="button" class="btn bg-gradient-primary"
                                                                    data-bs-dismiss="modal" @click="Save()">
                                                                    Guardar
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-7">
                                        <h5 class="ms-1">Movimientos de stock</h5>
                                        <div class="table table-responsive">
                                            <table class="table align-items-center mb-0 table-sm">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="text-uppercase text-left text-secondary text-xxs font-weight-bolder opacity-7 px-1">
                                                            Detalle
                                                        </th>
                                                        <th
                                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Cantidad
                                                        </th>
                                                        <th
                                                            class="text-uppercase text-secondary text-left text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Compra
                                                        </th>
                                                        <th
                                                            class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                            Venta
                                                        </th>
                                                        <th
                                                            class="text-left text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody v-for="m in model.inventarios">
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex px-1 py-1">
                                                                <div class="text-xxs">{{ m.motivo }} </div>
                                                                <!--Muestra en pantalla los motivos que se pongan en ajustar stock-->
                                                                <div class="d-flex flex-column justify-content-center">
                                                                    <!--<h6 class="mb-0 text-xxs">, -</h6> -->
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <h6><span class="badge text-xxs"
                                                                    :class="[m.tipo==2? 'badge-danger' : 'badge-success']">{{
                                                                        m.cantidad }}<!-- --> {{ model.medida.nombre }}</span>
                                                            </h6>
                                                        </td>
                                                        <td class="text-xxs">{{ Number(m.compra).toFixed(2) }}</td>
                                                        <td class="align-middle text-sm text-xxs">{{
                                                            Number(m.venta).toFixed(2) }}</td>
                                                        <td class="align-middle text-center text-xxs">
                                                            <a href="javascript:void(0);" @click="DeleteItem(m.id)"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-original-title="Delete product">
                                                                <i class="fas fa-trash text-danger" aria-hidden="true"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
            load: true,
            list: [],
            apiUrl: "inventarios",
            page: "Inventario",
            modulo: "General",
            model: {
                nombre: '',
                barra: '',
                stock_minimo: 0,
                compra: 0,
                venta: 0,
                marca_id: '',
                medida_id: '',
                categoria_id: '',
                marca: {
                    nombre: '',
                },
                categoria: {
                    nombre: '',
                },
                medida: {
                    nombre: '',
                    codigo: '',
                },
                inventarios: [],
            },
            inventario: {
                tipo: 1,
                cantidad: 1,
                motivo: '',
            },

            url_editar: "/inventario/kardex/",
        };
    },
    methods: {
        async GET_DATA(path) {
            const res = await this.$api.$get(path);
            return res;
        },
        async Save() { //Hace que se guarden los datos 


            if (!this.model.nombre) {
                // Si el campo 'nombre' está vacío, muestra un mensaje de error
                this.$swal.fire('Por favor, ingrese un nombre', '', 'error');
                return;
            }
            this.load = true
            let self = this
            try {
                this.inventario.articulo_id = this.model.id
                this.inventario.compra = this.model.compra
                this.inventario.venta = this.model.venta
                const res = await this.$api.$post('inventarios', this.inventario);
                console.log( res);

                // Mostrar SweetAlert2 para confirmar la acción
                const result = await this.$swal.fire({
                    title: '¿Seguro que quiere guardar los cambios?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    denyButtonText: `Cancelar`,
                });

                //este if, hace que si se presiona guardar, se guarde, en caso de cancelar, no se guarda
                if (result.isConfirmed) {
                    
                    await Promise.all([self.GET_DATA('inventarios/kardex/' + self.$route.params.id)]).then((v) => { //trae el stock actual, ganancia, valoración
                        self.model = v[0];
                        this.$swal.fire('Guardado con éxito!', '', 'success');
                        
                    }); // 'inventarios' indica que tiene que ir a la api inventarios y this.inventario hace que mande el objeto inventario
                
                } else if (result.isDenied) {
                    this.$swal.fire('Cambios descartados', '', 'info'); // Mostramos un mensaje informativo
                }

            } catch (e) {
                console.log(e);
            } finally {
                this.load = false;
            }
        },
        async EliminarItem(id) {
            this.load = true;
            try {
                const res = await this.$api.$delete("inventarios/" + id);
                console.log(res);
                await Promise.all([this.GET_DATA('inventarios/kardex/' + this.$route.params.id)]).then((v) => { //trae el stock actual, ganancia, valoración
                    this.model = v[0];
                });
            } catch (e) {
                console.log(e);
            } finally {
                this.load = false;
            }
        },
        DeleteItem(id) {
            let self = this;
            this.$swal
                .fire({
                    title: "¿Seguro que desea eliminar el movimiento?",
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: "Eliminar",
                    cancelarButtonText: `Cancelar`,
                })
                .then(async (result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        await self.EliminarItem(id);
                    }
                });
        },
    },
    mounted() {
        this.$nextTick(async () => {
            try {
                await Promise.all([this.GET_DATA('inventarios/kardex/' + this.$route.params.id)]).then((v) => {
                    this.model = v[0];
                });
            } catch (e) {
                console.log(e);
            } finally {
                this.load = false;
            }
        });
    },
};
</script>
  