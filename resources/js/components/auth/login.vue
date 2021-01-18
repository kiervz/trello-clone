<template>
    <div class="container">
        <br><br>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mx-auto">
                    <div class="card-body">
                        <span class="text-danger" v-if="error">
                            <div class="alert alert-danger" role="alert">{{ error }}</div>
                        </span>
                        <div class="form-group">
                            <label>Email address</label>
                            <input
                                v-model="form['email']"
                                type="email"
                                class="form-control"
                                placeholder="Email">
                            <span class="text-danger" v-if="errors.email">{{ errors.email[0] }}</span>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input
                                v-model="form['password']"
                                type="password"
                                class="form-control"
                                placeholder="Password">
                            <span class="text-danger" v-if="errors.password">{{ errors.password[0] }}</span>
                        </div>

                        <button
                            class="btn btn-sm btn-primary form-control"
                            @click="login">
                            Login
                        </button>
                        <div class="mt-5 text-center">
                            <router-link to="/register" class="text-decoration-none">Create your Account</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                form: {
                    email: null,
                    password: null,
                },
                error: null,
                errors:{},
            }
        },
        methods: {
            login() {
                axios.get('/sanctum/csrf-cookie').then(response => {
                    axios.post('api/auth/login', this.form)
                        .then(res => {
                            console.log(res)
                        })
                        .catch(error => {
                            let status = error.response.status
                            if (!status == 401 || status == 422) {
                                this.errors = error.response.data.errors
                            }
                            else if (status == 429) {
                                this.error = error.response.data.errors.email[0]
                            }
                            else {
                                this.error = error.response.data.error
                            }
                        });
                });
            }
        }
    }
</script>
