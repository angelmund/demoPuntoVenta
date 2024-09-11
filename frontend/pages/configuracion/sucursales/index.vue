<!--- 
<template>
    <div>

        <AdminTemplate :page="page" :modulo="modulo">
            <div slot="body">
                <div class="row justify-content-center">

                    <div class="col-sm-8 col-12">
                        <div class="card">
                            <div class="card-header ">
                                <h3>Agregar</h3>
                            </div>
                            <div class="card-body"><!--CrudCreate es el componente que está en a carpeta Crud, pero el archivo se llama Create
                                <CrudUpdate v-if="list.length>0" :model="model" :apiUrl="apiUrl">
                                    <div slot="body" class="row">
                                        <div class="form-group col-12">
                                            <label for="">Nombre</label>
                                            <input type="text" name="" v-model="model.nombre" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="">Direcci&oacute;n</label>
                                            <input type="text" name="" v-model="model.direccion" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="">Tel&eacute;fono</label>
                                            <input type="text" name="" v-model="model.telefono" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="">Impresora</label>
                                            <input type="text" name="" v-model="model.impresora" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="">Impresora URL</label>
                                            <input type="text" name="" v-model="model.impresora_url" class="form-control" id="">
                                        </div>
                                    </div>

                                </CrudUpdate> <!--- Termina el componente Create de la carpeta Crud-->
                                <!--CrudCreate es el componente que está en a carpeta Crud, pero el archivo se llama Create
                                <CrudCreate v-else :model="model" :apiUrl="apiUrl">
                                    <div slot="body" class="row">
                                        <div class="form-group col-12">
                                            <label for="">Nombre</label>
                                            <input type="text" name="" v-model="model.nombre" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="">Direcci&oacute;n</label>
                                            <input type="text" name="" v-model="model.direccion" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="">Tel&eacute;fono</label>
                                            <input type="text" name="" v-model="model.telefono" class="form-control" id="">
                                        </div>
                                    
                                        <div class="form-group col-12">
                                            <label for="">Impresora</label>
                                            <input type="text" name="" v-model="model.impresora" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="">Impresora URL</label>
                                            <input type="text" name="" v-model="model.impresora_url" class="form-control" id="">
                                        </div>
                                    </div>

                                </CrudCreate> <!--- Termina el componente Create de la carpeta Crud
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AdminTemplate>
    </div>
</template>  -->
<template>
    <div>
        <JcLoader :load="load"></JcLoader>
        <AdminTemplate :page="page" :modulo="modulo">
            <div slot="body">
                <div class="row justify-content-end">
                    <div class="col-2">
                        <nuxtLink :to=" url_nuevo" type="button" class="btn btn-dark btn-sm w-100">
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
                                        <th class="py-0 px-1">Nombre de la Sucural</th>
                                        <th class="py-0 px-1">Direcci&oacute;n</th>
                                        <th class="py-0 px-1">Tel&eacute;fono</th>
                                        <th class="py-0 px-1">Impresora</th>
                                        <th class="py-0 px-1">Impresora Dirreci&oacute;n</th>
                                        <th class="py-0 px-1"></th>
                                        
                                    </thead>
                                    <tbody>
                                        <tr v-for="(m, i) in list">
                                            <!--  Manda a llamar los registros -->
                                            <td class="py-0 px-1">{{ i + 1 }}</td>
                                            <td class="py-0 px-1">{{ m.nombre }}</td>
                                            <td class="py-0 px-1">{{ m.direccion }}</td>
                                            <td class="py-0 px-1">{{ m.telefono }}</td>
                                            <td class="py-0 px-1">{{ m.impresora }}</td>
                                            <td class="py-0 px-1">{{ m.impresora_url }}</td>
                                        
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
    name: "IndexPage",
    head() {
        return {
            title: this.modulo,
        };
        ;
    },
    data() {
        return {
            load: true,
            m: {
                nombre: "",
                direccion: '',
                documento: '',
                telefono: '',
                impresora: '',
                impresora_url: '',

            },
            url_editar: '/configuracion/sucursales/editar/',
            url_nuevo: '/configuracion/sucursales/nuevo',
            apiUrl: 'sucursales',
            page: 'Configuracion',
            modulo: 'Sucursales',
            list: [],

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
                const res = await this.$api.$delete(this.apiUrl+'/' + id); // hace refencia a marcas y al id que se quiere eliminar  
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
