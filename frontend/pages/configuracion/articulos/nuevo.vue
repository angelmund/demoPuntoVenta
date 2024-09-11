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
                                <CrudCreate :model="model" :apiUrl="apiUrl">
                                    <div slot="body" class="row">
                                        <div class="form-group col-12">
                                            <label for="">Nombre</label>
                                            <input type="text" name="" v-model="model.nombre" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="">Código de Barra</label>
                                            <input type="text" name="" v-model="model.barra" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="" >Marca</label>
                                            <select name="" id="" class="form-control" v-model="model.marca_id">
                                                <option v-for="m in marcas" :value="m.id">{{ m.nombre }}</option>
                                            </select> 
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Unidad de Medida</label>
                                            <select name="" id="" class="form-control" v-model="model.medida_id">
                                                <option v-for="m in medidas" :value="m.id">{{ m.nombre }} - {{ m.codigo }}</option>
                                            </select> 
                                        </div>

                                        <div class="form-group col-6"> <!-- col-6 hace que sea más pequeño -->
                                            <label for="">Categoría</label>
                                            <!-- v-for="m in categorias" hace referencia categorias para mostrar los registros -->
                                            <select name="" id="" class="form-control" v-model="model.categoria_id">
                                                <option v-for="m in categorias" :value="m.id">{{ m.nombre }}</option> <!-- {{ m.nombre }} manda a llamar el registro -->
                                            </select> 
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Stock </label>
                                            <input type="text" name="" v-model.number="model.stock_minimo" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Precio de compra</label>
                                            <input type="text" name="" v-model.number="model.compra" class="form-control" id="">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="">Precio de Venta</label>
                                            <input type="text" name="" v-model.number="model.venta" class="form-control" id="">
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
                nombre: '',
                barra:'',
                stock_minimo:'',
                compra :'',
                venta :'',
                marca_id:'',
                medida_id:'',
                categoria_id:'',
            },
            apiUrl: 'articulos',
            page: 'Configuracion',
            modulo: 'Artículos',
            marcas:[],
            medidas:[],
            categorias:[],

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
                await Promise.all([this.GET_DATA('marcas'),this.GET_DATA('medidas'),this.GET_DATA('categorias')]).then((v) => {
                    this.marcas = v[0]; //obtienen los registros
                    this.medidas = v[1]; //obtienen los registros
                    this.categorias = v[2]; //obtienen los registros
                    
                    //hace que no se queden vacíos los campos, tomando registros de la bd
                    if(this.marcas.length){
                        this.model.marca_id = this.marcas[0].id //el 0 toma el registro 0 del arreglo
                    }
                    if(this.medidas.length){
                        this.model.medida_id = this.medidas[0].id //el 0 toma el registro 0 del arreglo
                    }
                    if(this.categorias.length){
                        this.model.categoria_id = this.categorias[0].id//el 0 toma el registro 0 del arreglo
                    }
                    
                });
            }
            catch (e) {
                console.log(e); //muestra el mensaje de error
            } finally {
                this.load = false
            }

        });
    },

};
</script>
