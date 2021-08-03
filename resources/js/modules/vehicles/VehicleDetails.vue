<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
    
                <div class="card">
                    <div class="card-header">Jármű adatlap </div>
    
                    <div class="card-body">

                        <Loading size="3" v-if="!loaded" />
                        <div v-else>
                            <p>Jármű Név: {{vehicle.name}}</p>
                             <p>Tulaj. email: {{vehicle.owner_email}}</p>
 <p class="border p-3">
 <h4>Címkék:</h4>
                               <ul class="list-inline" v-if="vehicle.labels.length > 0">
                                <li class="list-inline-item border p-1 m-1" v-for="label  in vehicle.labels">
                                    {{ label.name }}
                                </li>
                            </ul>
 </p>
                             
                        </div>
                    </div>
                </div>

                <div class="card" v-if="loaded">
                    <div class="card-header d-flex justify-content-between">

                    <span>Ellenőrző lapok</span>

                     <router-link :to="`/check-sheets/create/${vehicle.id}`" class="">+ Ellenőrző lap</router-link>
                     </div>
    
                    <div class="card-body" >
                        <table class="table" >
                            <thead>
                                <tr>
                                    <th scope="col">Jármű Név</th>
                                    <th scope="col">Munka</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr :key="check_sheet.id" v-for="check_sheet  in vehicle.check_sheets">
                                    <td>{{check_sheet.vehicle_name}}</td>
                                    <td>{{check_sheet.job}}</td>
                                    <td>
                                     <router-link :to="`/check-sheets/${check_sheet.id}`" class="">Részletek</router-link>
                                     
                                     </td>
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