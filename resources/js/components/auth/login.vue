<template>
    <v-container>
        <v-card class="mx-auto mt-16" width="500">
            <v-card-text>
                <h1>Login</h1>
                <v-alert
                    dense
                    outlined
                    type="error"
                    v-if="error"
                    >
                    {{ error }}
                </v-alert>
                <v-form
                    ref="form"
                    lazy-validation
                >

                    <v-text-field
                        v-model="form['email']"
                        label="Email"
                        type="email"
                    ></v-text-field>
                    <span class="red--text" v-if="errors.email">{{ errors.email[0] }}</span>

                    <v-text-field
                        v-model="form['password']"
                        type="password"
                        label="Password"

                    ></v-text-field>
                    <span class="red--text" v-if="errors.password">{{ errors.password[0] }}</span>

                    <v-btn
                        class="mr-4"
                        color="primary"
                        @click="login"
                        block>
                        Login
                    </v-btn>
                </v-form>
                <div class="mt-5 text-center">
                    <router-link to="/register" class="text-decoration-none">Create your Account</router-link>
                </div>
            </v-card-text>
        </v-card>
    </v-container>
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
                            User.responseAfterLogin(res)
                            this.$router.push({path: '/'})
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
