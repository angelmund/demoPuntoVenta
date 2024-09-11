<template>
    <div>
        <JcLoader :load="load"></JcLoader>
        <AdminTemplate :page="page" :modulo="modulo">
            <div slot="body">
                <div class="row justify-content-end">
                    <div class="col-2">
                        <nuxtLink :to="url_nuevo" type="button" class="btn btn-dark btn-sm w-100">
                            Agregar
                            <i class="fas fa-plus"></i>
                        </nuxtLink>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <thead>
                                        <!-- Nombres de en la tabla -->
                                        <th class="py-0 px-1">#</th>
                                        <th class="py-0 px-1">Nombre del Producto</th>
                                        <th class="py-0 px-1">Código de barras</th>
                                        <th class="py-0 px-1">Marca</th>
                                        <th class="py-0 px-1">Categoría</th>
                                        <th class="py-0 px-1">Art.Disponibles</th>
                                        <th class="py-0 px-1">Unidad de Medida</th>
                                        <th class="py-0 px-1">compra</th>
                                        <th class="py-0 px-1">venta</th>
                                        <th class="py-0 px-1">Acciones</th>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m, i) in list">
                                            <!--  Manda a llamar los registros -->
                                            <td class="py-0 px-1">{{ i + 1 }}</td>
                                            <td class="py-0 px-1">{{ m.nombre }}</td>
                                            <td class="py-0 px-1">{{ m.barra }}</td>
                                            <!--- Hcace que verifique si hay o no un registro    -->
                                            <td class="py-0 px-1">
                                                <span v-if="m.marca">{{ m.marca.nombre }}</span>
                                                <span v-else>Marca no disponible</span>
                                            </td>
                                            <td class="py-0 px-1">
                                                <span v-if="m.categoria">{{ m.categoria.nombre }}</span>
                                                <span v-else>Categoría no disponible</span>
                                            </td>
                                            <td class="py-0 px-1">
                                                <span v-if="m.stock_minimo">{{ m.stock_minimo }}</span>
                                                <span v-else>No hay Stock</span>
                                            </td>
                                            <td class="py-0 px-1">{{ m.medida.nombre }} <!--{{ m.medida.codigo }} ---></td>
                                            <td class="py-0 px-1">{{ m.compra }}</td>
                                            <td class="py-0 px-1">{{ m.venta }}</td>

                                            <!-- Termina la verificación-->
                                            <!-- Termina Manda a llamar los registros -->

                                            <!-- Botones -->
                                            <td>
                                                <div class="btn-group">
                                                    <nuxt-link :to="url_editar + m.id" class="btn btn-info  py-2 px-3"
                                                        style="margin-right: 10px;">
                                                        <i class="fas fa-pen"></i>
                                                    </nuxt-link>
                                                    <button type="button" @click="Eliminar(m.id)"
                                                        class="btn btn-danger  py-2 px-3">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>


                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
        ;
    },

    data() {
        return {
            load: true,
            list: [],
            apiUrl: 'articulos',
            page: 'Configuración',
            modulo: 'Artículos',
            url_nuevo: '/configuracion/articulos/nuevo',
            url_editar: '/configuracion/articulos/editar/',

        };
    },
    methods: {
        async GET_DATA(path) { //obtiene la url a donde se quiere ir 
            const res = await this.$api.$get(path); // obtiene la url y la concatena con la api 
            return res
        },
        async EliminarItem(id) { //obtiene el id del registro a eliminar 
            this.load = true
            try {
                //llama al o los registros 
                const res = await this.$api.$delete(this.apiUrl + "/" + id); // hace refencia al modelo categorias y al id que se quiere eliminar  
                console.log(res)
                //llama al o los registros 
                await Promise.all([this.GET_DATA(this.apiUrl)]).then((v) => {
                    this.list = v[0] //obtiene el registro y list se refiere a la lista de datos
                });
            } catch (e) {
                console.log(e); //muestra el mensaje de error
            } finally {
                this.load = false
            }

        },
        Eliminar(id) { //es el mtodo para eliminar un registro
            let self = this
            this.$swal.fire({
                title: '¿Seguro que desea eliminar?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                CancelarButtonText: `Cancelar`,
            }).then(async (result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    await self.EliminarItem(id)
                }
            })
        }
    },
    mounted() {
        this.$nextTick(async () => {
            //se mete en un try catch por algún error 
            try {
                //llama al o los registros 
                await Promise.all([this.GET_DATA(this.apiUrl)]).then((v) => {
                    this.list = v[0] //obtiene el registro y list se refiere a la lista de datos
                });
            }
            catch (e) {
                console.log(e); //muestra el mensaje de error
            } finally { //si no hubo error finalmente se quita el circulo de cargando
                this.load = false
            }

        });
    },

};
</script>
