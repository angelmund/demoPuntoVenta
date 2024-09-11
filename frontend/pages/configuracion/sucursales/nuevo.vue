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
                            <div class="card-body"><!--CrudCreate es el componente que está en a carpeta Crud, pero el archivo se llama Create-->
                                <!--CrudCreate es el componente que está en a carpeta Crud, pero el archivo se llama Create-->
                                <CrudCreate :model="model" :apiUrl="apiUrl">
                                    <div slot="body" class="row">
                                        <div class="form-group col-12">
                                            <label for="">Nombre de la sucursal</label>
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

                                </CrudCreate> <!--- Termina el componente Create de la carpeta Crud-->
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
            model: {
                nombre: "",
                direccion: '',
                documento: '',
                telefono: '',
                impresora: '',
                impresora_url: '',

            },
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
