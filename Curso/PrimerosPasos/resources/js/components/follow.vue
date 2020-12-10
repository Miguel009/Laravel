<template>
    <div>
        <button class="btn btn-primary ml-4" @click="followUser" v-text="buttonText">
            
        </button>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'follows'],
        mounted() {
            console.log('Component mounted.')
        },
        /*aqui se manda a llamar un data el cual manda o devuelve un argumento el cual es status que va a ser false o true dependiendo de lo que devuelva follows */
        data:function (){
            return {
                status: this.follows,
            }
        },
        methods:{
            followUser()
            {
                /*aqui lo que hace es que hace un post utilizando axios el cual realiza la accion de seguir o no y segun la respuesta como es un pivote de solo true o false 
                entonces pasaria solo esos dos tipos de datos y entonces cambiamos estatus de dato */
                console.log(this.userId);
                axios.post('/follow/'+this.userId).then(response=>{
                    this.status = !this.status;
                })
                .catch(error=>{
                    /*Aqui lo que manejamos es que si no estamos en una cuenta entonces solo */
                    if(error.response.status==401){
                        window.location = '/login'
                    }
                    
                }
                );
            }
        },

        computed: {
            buttonText(){
                return(this.status) ? 'Dejar de Seguir' : 'seguir';
            }
        }
    }
</script>
