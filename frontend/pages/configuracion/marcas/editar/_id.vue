<template>
    <div>

        <JcLoader :load="load"></JcLoader>
        <AdminTemplate :page="page" :modulo="modulo">
            <div slot="body">
                <div class="row justify-content-center">
                    <div class="col-sm-8 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Actualizar</h3>
                            </div>
                            <div class="card-body ">
                                <!--CrudCreate es el componente que está en a carpeta Crud, pero el archivo se llama Create-->
                                <CrudUpdate :model="model" :apiUrl="apiUrl">
                                    <div slot="body" class="row">
                                        <div class="form-group col-12">
                                            <label for="">Nombre</label>
                                            <input type="text" name="" v-model="model.nombre" class="form-control" id="">
                                        </div>
                                        <!-- model.nombre  es quien indica qsobre qué columna se va atrabjar-->
                                    </div>

                                </CrudUpdate> <!--- Termina el componente Create de la carpeta Crud-->
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
        
    },
    data() {
        return {
            load: true,

            model: {
                nombre: '',
                
            },
            apiUrl: 'marcas',
            page: 'Configuración',
            modulo: 'Marcas',
           // url_nuevo:'/configuracion/medidas/nuevo',
           // url_editar:'/configuracion/medidas/editar/',

        };
    },
    methods: {
        async GET_DATA(path) {
            const res = await this.$api.$get(path);
            return res
        },
        /*
        async Save() {
            if (!this.model.nombre) {
                // Si el campo 'nombre' está vacío, muestra un mensaje de error
                this.$swal.fire('Por favor, ingrese un nombre', '', 'error');
                return;
            }
            this.load = true;
            try {
                const shouldUpdate = await this.showUpdateConfirmation();

                if (shouldUpdate) {
                    const res = await this.$api.$put(this.apiUrl+'/' + this.model.id, this.model);
                    console.log(res);
                    this.$swal.fire('Guardado con éxito!', '', 'success');
                    this.$router.back();
                }
            } catch (e) {
                console.log(e);
            } finally {
                this.load = false;
            }
        } */
        showUpdateConfirmation() {
            return new Promise((resolve) => {
                this.$swal
                    .fire({
                        title: '¿Seguro que quiere guardar los cambios?',
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'Guardar',
                        denyButtonText: 'Cancelar',
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            resolve(true); // Usuario confirmó, permitir la actualización
                        } else if (result.isDenied) {
                            resolve(false); // Usuario canceló, no permitir la actualización
                        }
                    });
            });
        },
    },
    mounted() {
        this.$nextTick(async () => {


            //se mete en un try catch por algún error 
            try {
                //llama al o los registros 
                await Promise.all([this.GET_DATA(this.apiUrl+'/' + this.$route.params.id)]).then((v) => { // marcas/'+this.$router.params,id consulta la api y devuelve la cadena
                    this.model = v[0] //obtiene el registro y list se refiere a la lista de datos
                })
            }
            catch (e) {
                console.log(e); //muestra el mensaje de error
            } finally { //si no hubo error finalmente se quita el circulo de cargando
                this.load = false
            }


        });
    }
};
</script>