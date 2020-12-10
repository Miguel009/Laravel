<template>
    <div>
        <button class="btn btn-primary ml-4" @click="followUser">
            Seguir
        </button>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        mounted() {
            console.log('Component mounted.')
        },

        methods:{
            followUser()
            {
                console.log(this.user);
                axios.post('/follow/'+this.user).then(response=>{
                    alert(response.data);
                });
            }
        }
    }
</script>
