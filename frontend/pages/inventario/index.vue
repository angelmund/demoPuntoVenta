<template>
    <div>
        <JcLoader :load="load"></JcLoader>
        <AdminTemplate :page="page" :modulo="modulo">
            <div slot="body">
                <div class="row justify-content-end">

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
                                        
                                        <th class="py-0 px-1">Inversion</th>
                                        <th class="py-0 px-1">Valorizado</th>
                                        <th class="py-0 px-1">Ganancia</th>
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
                                            <td class="py-0 px-1"
                                                :class="[m.stock <= 10 ? 'badge-danger' : 'badge-success']">
                                                <span v-if="m.stock" >{{ m.stock }} {{ m.medida.nombre}}</span>
                                                <span v-else>No hay Stock</span>
                                                <span v-if="m.stock <= 10 && m.stock > 0"><i class="fa fa-warning"></i>
                                                </span>
                                            </td>
                                            
                                            <td class="py-0 px-1">${{ Number( m.inversion).toFixed(2)  }}</td>
                                            <td class="py-0 px-1">${{ Number( m.valorizado).toFixed(2)  }}</td>
                                            <td class="py-0 px-1">${{ Number(m.ganancia).toFixed(2) }}</td>

                                            <!-- Termina la verificación-->
                                            <!-- Termina Manda a llamar los registros -->

                                            <!-- Botones -->
                                            <td>
                                                <div class="btn-group">
                                                    <nuxt-link :to="url_editar + m.id"
                                                        class="btn btn-success  btn-sm py-2 px-4">
                                                        <i class="fas fa-eye" style="font-size: 20px;"></i>
                                                        <!-- Agregando la clase fa-lg -->
                                                    </nuxt-link>
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
            apiUrl: 'inventarios',
            page: ' Inventario',
            modulo: 'General',

            url_editar: '/inventario/kardex/',

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
            }

        });
    },

};
</script>
