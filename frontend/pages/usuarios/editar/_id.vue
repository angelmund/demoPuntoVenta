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
                                 <CrudUpdate :model="m" :apiUrl="apiUrl">
                                    <div slot="body" class="row">
                                        <div class="form-group col-12">
                                            <label for="">Nombre</label>
                                            <input type="text" name="" v-model="m.nombre" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="">Rol</label>
                                            <input type="text" name="" v-model="m.tipo" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="">Username</label>
                                            <input type="text" name="" v-model="m.username" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="">Email</label>
                                            <input type="text" name="" v-model="m.email" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="">Contrase&nacute;a</label>
                                            <input type="password" name="" v-model="m.password" class="form-control" id="">
                                        </div>
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
//import JcLoader from '/components/base/JcLoader.vue';

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

            m: {
                nombre: '',
                username:'',
                email:'',
                tipo:'',
                password:'',

            },
            apiUrl: 'users',
            page: 'Usuarios',
            modulo: 'Usuario',
            
        };
    },
    methods: {
        async GET_DATA(path) {
            const res = await this.$api.$get(path);
            return res
        },
       
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
                    this.m = v[0]; //obtienen los registros
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
