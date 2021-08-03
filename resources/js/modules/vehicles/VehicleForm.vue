<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
    
                <div class="card">
                    <div class="card-header">Új jármű </div>
    
                    <div class="card-body">
    
                        <form method="POST" @submit.prevent="onSubmit">
    
    
                            <div class="form-group">
                                <label for='name'>Név</label>
                                <input v-model.trim="form.name" type="text" class="form-control" :class="inputClass('name')" />
                                <div class="invalid-feedback" v-if="errors.name">
                                    {{ errors.name[0] }}
                                </div>
                            </div>
    
                            <div class="form-group mt-3">
                                <label for='owner_email'>Tulaj. email</label>
                                <input v-model.trim="form.owner_email" type="text" class="form-control" :class="inputClass('owner_email')" />
                                <div class="invalid-feedback" v-if="errors.owner_email">
                                    {{ errors.owner_email[0] }}
                                </div>
                            </div>
    
                            <h4>Címkék:</h4>
                            <button type="button" class="btn btn-sm btn-secondary mx-2" @click="openLabelModal">címke +</button>
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
    <div class="modal fade" id="labelModal" tabindex="-1" aria-labelledby="labelModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <LabelForm @label-added="labelAdded" />
            </div>
        </div>
    </div>
</template>

<script>
import FormHelper from '../../FormHelper.js';
import Swal from 'sweetalert2';
import { Modal } from 'bootstrap';
import LabelForm from '../LabelForm.vue';
export default {
    components: { LabelForm },
    mounted() {
        axios.get(`labels`)
            .then((response) => {
                this.labels = response.data.data;
                this.loaded = true;
            })
            .catch((error) => {
                console.error(error);
            });

        this.labelModal = new Modal(document.getElementById('labelModal'), { keyboard: false });
    },
    data() {
        return {
            disabled: false,
            form: {
                name: '',
                owner_email: '',
                labels: []
            },
            labels: [],
            errors: {},
            labelModal: null
        }
    },
    methods: {
        onSubmit() {
            this.disabled = true;
            axios.post('user/vehicles/create', this.form)
                .then((response) => {
                    this.disabled = false;
                    if ('id' in response.data) {
                        this.errors = {};
                        Swal.fire({
                            icon: 'success',
                            title: `Létrehozva`,
                            timer: 1000
                        });
                        this.$router.push(`/vehicles/edit/${response.data.id}`)
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
        },
        openLabelModal() {
            this.labelModal.show();
        },
        labelAdded(newLabel) {
            this.labels.push(newLabel);
            this.labelModal.hide();
        },
    }
}
</script>