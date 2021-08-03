<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
    
                <div class="card">
                    <div class="card-header">Adatlap </div>
    
                    <div class="card-body">

                        <Loading size="3" v-if="!loaded" />

                       
    
                        <div v-else>
                            <p>Jármű Név: {{vehicle.name}}</p>
                             <p>Tulaj. email: {{vehicle.owner_email}}</p>
                        </div>

    
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</template>

<script>
import Loading from '../../components/Loading.vue';
export default {
    mounted() {

        axios.get(`user/vehicles/${this.$route.params.id}`)
            .then((response) => {
                this.loaded = true;
                this.vehicle = response.data.data;
            })
            .catch((error) => {
                console.error(error);
            });
    },
    data() {
        return {
            loaded: false,
            vehicle: null
        }
    },
    methods: {

    }
}
</script>