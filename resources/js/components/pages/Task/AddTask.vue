<template>
    <div>
        <v-list-item-content>
            <v-flex md11 sm10 xs10>
                <h2 class="ml-3 mt-2">Tasks</h2>
            </v-flex>
            <v-flex md1 sm2 xs2>
                <v-btn
                    elevation="4"
                    small
                    dark
                    :color="!is_add ? 'primary' : 'error'"
                    fab
                    @click="is_add = !is_add">
                    <v-icon v-if="!is_add">mdi-plus</v-icon>
                    <v-icon v-else>mdi-close</v-icon>
                </v-btn>
            </v-flex>
        </v-list-item-content>
        <v-list-item-content v-if="is_add">
            <v-container>
                <v-alert
                    dense
                    outlined
                    type="error"
                    v-if="error"
                    >
                    {{ error }}
                </v-alert>
            </v-container>
            <v-flex md11 sm10 xs10>
                <v-text-field
                    label="Add Task*"
                    required
                    v-model="task_name"
                    class="mr-3 ml-5"
                    @keydown.enter="add(task_name)">
                ></v-text-field>
            </v-flex>
            <v-flex md1 sm2 xs2>
                <v-btn
                    elevation="4"
                    small
                    dark
                    color="primary"
                    fab
                    @click="add(task_name)">
                    <v-icon>mdi-plus</v-icon>
                </v-btn>
            </v-flex>
        </v-list-item-content>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                task_name: null,
                is_add: false,
                error: null,
            }
        },
        methods: {
            add(name) {
                axios.post('api/task', {
                        task_name: name
                    })
                    .then(data => {
                        EventBus.$emit('newTask')
                        this.task_name = null
                        this.is_add = false
                    })
                    .catch(error => {
                        this.error = error.response.data.errors.task_name[0]
                    })
            },
            color() {
                let color = !this.is_add ? 'primary' : 'red'
                alert(color)
                return color
            }
        }
    }
</script>
