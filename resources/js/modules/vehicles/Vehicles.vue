<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
    
                    <div class="card-header d-flex justify-content-between">
                        <span>Vehicles</span>
                        <span><router-link to="/vehicles/create" class="">+ Jármű</router-link></span>
                    </div>
                    <div class="card-body">
                        <Loading size="3" v-if="!loaded" />
    
                        <table class="table" v-if="loaded">
                            <thead>
                                <tr>
                                    <th scope="col">Jármű Név</th>
                                    <th scope="col">Tulaj. email</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr :key="vehicle.id" v-for="vehicle in vehicles">
                                    <td>{{vehicle.name}}</td>
                                    <td>{{vehicle.owner_email}}</td>
                                    <td><router-link :to="`/vehicles/edit/${vehicle.id}`" class="">Adatlap</router-link></td>
                                </tr>
    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Loading from '../../components/Loading.vue';

export default {
    components: {
        Loading
    },
    data() {
        return {
            loaded: false,
            vehicles: [],
        }
    },
    mounted() {
        axios.get(`user/vehicles`)
            .then((response) => {
                this.loaded = true;
                this.vehicles = response.data.data;
            })
            .catch((error) => {
                console.error(error);
            });
    },
    methods: {
        /*function() {
           
        }*/
    }
}
</script>