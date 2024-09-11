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
                                        <div class="form-group col-12">
                                            <label for="">Barra</label>
                                            <input type="text" name="" v-model="model.barra" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Marca</label>
                                            <select name="" id="" class="form-control" v-model="model.marca_id">
                                                <option v-for="m in marcas" :value="m.id">{{ m.nombre }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Unidad de Medida</label>
                                            <select name="" id="" class="form-control" v-model="model.medida_id">
                                                <option v-for="m in medidas" :value="m.id">{{ m.nombre }} - {{ m.codigo }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6"> <!-- col-6 hace que sea más pequeño -->
                                            <label for="">Categoría</label>
                                            <!-- v-for="m in categorias" hace referencia categorias para mostrar los registros -->
                                            <select name="" id="" class="form-control" v-model="model.categoria_id">
                                                <option v-for="m in categorias" :value="m.id">{{ m.nombre }}</option>
                                                <!-- {{ m.nombre }} manda a llamar el registro -->
                                            </select>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="">Stock</label>
                                            <input type="text" name="" v-model="model.stock_minimo" class="form-control"
                                                id="">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Precio de compra</label>
                                            <input type="text" name="" v-model="model.compra" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Precio de Venta</label>
                                            <input type="text" name="" v-model="model.venta" class="form-control" id="">
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

            model: {
                nombre: '',
                barra: '',
                stock_minimo: 0,
                compra: 0,
                venta: 0,
                marca_id: '',
                medida_id: '',
                categoria_id: '',
            },
            apiUrl: 'articulos',
            page: 'Configuracion',
            modulo: 'Artículos',
            marcas: [],
            medidas: [],
            categorias: [],

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
                await Promise.all([this.GET_DATA(this.apiUrl+'/' + this.$route.params.id),this.GET_DATA('marcas'),this.GET_DATA('medidas'),this.GET_DATA('categorias')]).then((v) => { // marcas/'+this.$router.params,id consulta la api y devuelve la cadena
                    this.model = v[0]; //obtienen los registros
                    this.marcas = v[1]; //obtienen los registros
                    this.medidas = v[2]; //obtienen los registros
                    this.categorias = v[3]; //obtienen los registros

                    //hace que no se queden vacíos los campos, tomando registros de la bd
                    if (this.marcas.length) {
                        this.model.marca_id = this.marcas[0].id //el 0 toma el registro 0 del arreglo
                    }
                    if (this.medidas.length) {
                        this.model.medida_id = this.medidas[0].id //el 0 toma el registro 0 del arreglo
                    }
                    if (this.categorias.length) {
                        this.model.categoria_id = this.categorias[0].id//el 0 toma el registro 0 del arreglo
                    }
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
