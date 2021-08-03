<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
    
                <div class="card">
                    <div class="card-header">Új ellenörző lap </div>
    
                    <div class="card-body">
    
                        <form method="POST" @submit.prevent="onSubmit" >
    
    
                            <div class="form-group">
                                <label for='job'>Munka elnevezése</label>
                                <input v-model.trim="form.job" type="text" class="form-control" :class="inputClass('job')" />
                                <div class="invalid-feedback" v-if="errors.job">
                                    {{ errors.job[0] }}
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label for='comment'>Megjegyzés</label>
                                <textarea v-model="form.comment" class="form-control" :class="inputClass('comment')"></textarea>
                                <div class="invalid-feedback" v-if="errors.comment">
                                    {{ errors.comment[0] }}
                                </div>
                            </div>

                            <ul class="list-inline">
                                <li class="list-inline-item border border-primary p-1 m-2" v-for="label  in labels">
                                    <input type="checkbox" :id="'label-'+label.id" v-model="form.labels" :value="label.id" />
                                            <label :for="'label-'+label.id" class="mx-2"> {{ label.name }}</label>
                                </li>
                            </ul>

                            <div class="d-flex justify-content-between  mt-3">
                                <div>
                                    <button type="submit" class="btn btn-primary" v-if="!disabled">Mentés </button>

                                    <button class="btn btn-primary" type="button" disabled="disabled" v-if="disabled">
                                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span> Sending...</span>
                                                    </button>
                                </div>
    
                            </div>
                        </form>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</template>

<script>
import FormHelper from '../../FormHelper.js';
import Swal from 'sweetalert2';

export default {
    mounted() {
       axios.get(`labels`)
            .then((response) => {
                this.labels = response.data.data;
                this.loaded = true;
            })
            .catch((error) => {
                console.error(error);
            });   
    },
    data() {
        return {
            disabled: false,
            form: {
                job: '',
                comment: '',
                 labels: []
            },
            labels: [],
            errors: {}
        }
    },
    methods: {
        onSubmit() {
            this.disabled = true;
            axios.post(`checksheets/create/${this.$route.params.vehicleId}`, this.form)
                .then((response) => {
                    this.disabled = false;
                    if ('id' in response.data) {
                        this.errors = {};
                        Swal.fire({
                            icon: 'success',
                            title: `Az ellenörző lap létrehozva`,
                            timer: 1000
                        });
                        this.$router.push(`/vehicles/edit/${this.$route.params.vehicleId}`)
                    }
                })
                .catch((error) => {
                    this.disabled = false;
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.error(error);
                    }
                });
        },
        inputClass(inputName) {
            return FormHelper.inputClass(inputName, this.errors)
        }
    }
}
</script>