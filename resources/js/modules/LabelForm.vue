<template>
    <form @submit.prevent="onSubmitLabelForm">
        <div class="modal-header">
            <h5 class="modal-title" id="labelModalLabel"> Új címke</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="form-group  mb-3">
                <label for="name">Name</label>
                <input v-model.trim="form.name" type="text" class="form-control" :class="inputClass('name')" />
                <div class="invalid-feedback" v-if="errors.name">
                    {{ errors.name[0] }}
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" v-if="!disabled">Save </button>
            <button v-if="disabled" class="btn btn-primary" type="button" disabled="disabled">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                <span> Sending...</span>
                                            </button>
    
        </div>
    </form>
</template>

<script>
import FormHelper from '../FormHelper.js';
export default {
    props: ['category'],
    data() {
        return {
            disabled: false,
            form: {
                name: ''
            },
            errors: {}
        }
    },
    methods: {
        onSubmitLabelForm() {
            this.disabled = true;

            axios.post('labels/create', this.form)
                .then((response) => {
                    this.disabled = false;

                    this.errors = {};
                    console.log('label' in response.data);
                    if ('label' in response.data) {
                        this.errors = {};
                        this.form.name = '';
                        this.disabled = false;
                        this.$emit("labelAdded", response.data.label)
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
