<template>
    <v-container>
        <v-card class="mx-auto mt-16" width="500">
            <v-card-text>
                <h1>Register</h1>
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
                    <div v-for="(item, $index) in items" :key="$index">
                        <v-text-field
                            :type="item.type"
                            v-model="form[item.name]"
                            :label="item.label"
                            :name="form[item.name]"
                        ></v-text-field>
                        <span class="red--text" v-if="errors[item.name]">{{ errors[item.name][0] }}</span>
                    </div>
                </v-form>

                <v-btn
                    class="mr-4"
                    color="primary"
                    @click="register"
                    block>
                    Signup
                </v-btn>
                <div class="mt-5 text-center">
                    Already have an Account? <router-link to="/login" class="text-decoration-none">Login</router-link>
                </div>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
    export default {
        name: "Register",
        data() {
            return {
                form: {
                    name: null,
                    email: null,
                    password: null,
                    password_confirm: null,
                },
                items: [
                    {
                        label: 'Name',
                        name: 'name',
                        required: 'required',
                        type: 'text'
                    },
                    {
                        label: 'Email',
                        name: 'email',
                        required: 'required',
                        type: 'email'
                    },
                    {
                        label: 'Password',
                        name: 'password',
                        required: 'required',
                        type: 'password'
                    },
                    {
                        label: 'Confirm Password',
                        name: 'password_confirm',
                        required: 'required',
                        type: 'password'
                    },
                ],
                error: null,
                errors: {}
            }
        },
        methods: {
            register() {
                axios.post('/api/auth/register', this.form)
                    .then(res => {
                        this.$router.push('/login');
                    })
                    .catch(error => {
                        let status = error.response.status
                        if (!status == 401 || status == 422) {
                            this.errors = error.response.data.errors
                        }
                        else {
                            this.error = error.response.data.error
                        }
                    });
            }
        }
    }
</script>
