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
                    color="primary"
                    fab
                    @click="is_add = !is_add">
                    <v-icon v-if="!is_add">mdi-plus</v-icon>
                    <v-icon v-else>mdi-close</v-icon>
                </v-btn>
            </v-flex>
        </v-list-item-content>
        <v-list-item-content>
            <v-flex md11 sm10 xs10>
                <v-text-field
                    label="Add Task*"
                    required
                    v-if="is_add"
                    v-model="task_name"
                    class="mr-3 ml-3"
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
                    class="ml-5"
                    v-if="is_add"
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
                is_add: false
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
                    .catch(error => console.log(error))
            }
        }
    }
</script>
