<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
    
                <div class="card">
                    <div class="card-header">Ellenörző lap </div>
    
                    <div class="card-body">
    
                        <Loading size="3" v-if="!loaded" />
    
                        <div v-else>
                            <ul class="list-group">
                                <li class="list-group-item">
                                <router-link :to="`/vehicles/edit/${checksheet.vehicle_id}`" class="">Jármű: {{ checksheet.vehicle_name }}</router-link>
                                
                                </li>
                                <li class="list-group-item">Munka megnevezése: {{ checksheet.job }}</li>
                                <li class="list-group-item">Megjegyzés: {{ checksheet.comment }}</li>
                            </ul>

                            <p class="border p-3">
                                <h4>Címkék:</h4>
                                <ul class="list-inline" v-if="checksheet.labels.length > 0">
                                    <li class="list-inline-item border p-1 m-1" v-for="label  in checksheet.labels">
                                        {{ label.name }}
                                    </li>
                                </ul>
                            </p>
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

        axios.get(`checksheets/${this.$route.params.checkSheetId}`)
            .then((response) => {
                this.loaded = true;
                this.checksheet = response.data.data;
            })
            .catch((error) => {
                console.error(error);
            });
    },
    data() {
        return {
            loaded: false,
            checksheet: null
        }
    },
    methods: {

    }
}
</script>