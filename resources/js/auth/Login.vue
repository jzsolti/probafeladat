<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
    
                    <div class="card-body">
    
                        <form method="POST" @submit.prevent="submitLogin">
    
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input v-model.trim="form.email" type="text" class="form-control" :class="inputClass('email')" />
                                <div class="invalid-feedback" v-if="errors.email">
                                    {{ errors.email[0] }}
                                </div>
                            </div>
    
                            <div class="form-group ">
                                <label for="password">Password</label>
                                <input v-model.trim="form.password" type="password" class="form-control" :class="inputClass('password')" />
                                <div class="invalid-feedback" v-if="errors.password">
                                    {{ errors.password[0] }}
                                </div>
                            </div>
                           
    
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary" v-if="!disabled">Login</button>
    
                                <button class="btn btn-primary" type="button" disabled="disabled" v-if="disabled">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span> Sending...</span>
                                    </button>
                            </div>
  
                        </form>
    
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useRoute } from 'vue-router';
export default {
    mounted() {
        
    },
    data() {
        return {
            disabled: false,
            form: {
                email: '',
                password: ''
            },
            errors: {}
        }
    },

    methods: {
        submitLogin() {
            this.disabled = true;
            
            axios.get('/sanctum/csrf-cookie')
                .then(() => {
                    return axios.post('login', this.form);
                }).then((response) => {

                    if ('logged_in' in response.data) {
                        localStorage.setItem('isAuthenticated', 1)
                        this.$store.commit('login')

                        //redirect 
                        this.$router.push('/')
                    } 
                    this.disabled = false;
                }).catch((error) => {
                    this.disabled = false;
                    this.form.password = '';
                    if (error.response && error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    } else {
                        console.error(error);
                    }
                });
        },
        inputClass(inputName) {
            if (Object.keys(this.errors).length === 0) {
                return '';
            } else if (inputName in this.errors) {
                return 'is-invalid';
            } else {
                return 'is-valid';
            }
        }
    }
}
</script>