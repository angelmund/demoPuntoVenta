<template>
    <div>
        <JcLoader :load="load"></JcLoader>
        <AdminTemplate :page="page" :modulo="modulo">
            <div slot="body">
                <div class="row justify-content-center">

                    <div class="col-sm-8 col-12">
                        <div class="card">
                            <div class="card-header ">
                                <h3>Agregar</h3>
                                
                            </div>
                            <div class="card-body">
                                <!--CrudCreate es el componente que está en a carpeta Crud, pero el archivo se llama Create-->
                                <CrudCreate :model="m" :apiUrl="apiUrl">
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
            m: {
                nombre: '',
                username:'',
                email:'',
                tipo:'',
                password:'',

            },
            apiUrl: 'users',
            page: 'Alta',
            modulo: 'Nuevo Usuario',

        };
    },
    mounted() {
        this.$nextTick(async () => {
            //se mete en un try catch por algún error 
            try {
                
            }
            catch (e) {
                console.log(e); //muestra el mensaje de error
            } finally {

            }

        });
    },

};
</script>
