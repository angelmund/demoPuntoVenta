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
                            <div class="card-body">
                                <!--CrudCreate es el componente que está en a carpeta Crud, pero el archivo se llama Create-->
                                <CrudCreate :model="model" :apiUrl="apiUrl">
                                    <div slot="body" class="row">
                                        <div class="form-group col-12">
                                            <label for="">Nombre</label>
                                            <input type="text" name="" v-model="model.nombre" class="form-control" id="">
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
            title: "Demo",
        };
        ;
    },
    data() {
        return {
            load: false,
            model: {
                nombre: ""
            },
            apiUrl: 'categorias',
            page: 'Configuracion',
            modulo: 'Categorías'

        };
    },
    methods: {
        /* async Save() { //Hace que se guarden los datos 
 
             if (!this.model.nombre) {
                 // Si el campo 'nombre' está vacío, muestra un mensaje de error
                 this.$swal.fire('Por favor, ingrese un nombre', '', 'error');
                 return;
             }
             this.load = true
             try {
                 
 
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
                     const res = await this.$api.$post('marcas', this.model); // marcas es la tabla 
                     this.$swal.fire('Guardado con éxito!', '', 'success');
                     this.$router.back();
                 } else if (result.isDenied) {
                     this.$swal.fire('Cambios descartados', '', 'info'); // Mostramos un mensaje informativo
                 }
 
             } catch (e) {
                 console.log(e);
             } finally {
                 this.load = false;
             }
         },*/

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
