<template>
    <div>
        <JcLoader :load="load"></JcLoader>
        
        <div class="row">
            <div class="col-12">
                <slot name="body">

                </slot>
            </div>
            <div class="col-12">
                <div class="row ">
                    <div class="col-6">
                        <button class="btn btn-dark w-100" @click="$router.back()">Regresar</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-info w-100" @click="Save()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import JcLoader from '../base/JcLoader.vue';

export default {

    
    props:{
        model:{
           type: Object,
           default:() =>{}
        },
        apiUrl:{
            type:String,
            default: ''
        }
    },
    data() {
        return {
            load:false,
            model: {
                nombre: ''
            }

        };
    },
        
    methods: {
        async Save() { //Hace que se guarden los datos 

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
                    const res = await this.$api.$post(this.apiUrl, this.model); // this.apiUrl indica que tiene que ser dinámico, es decir, tiene que tomar la url de la api
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
        },

    },

    mounted() {
        this.$nextTick(async () => {
            //se mete en un try catch por algún error 
            try {

            }
            catch (e) {
                console.log(e); //muestra el mensaje de error
            } finally { //si no hubo error finalmente se quita el circulo de cargando

            }

        });
    },
    components: {JcLoader}

};
</script>
