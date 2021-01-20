<template>
    <div>
        <v-row no-gutters>
            <v-col
                v-for="task in tasks"
                :key="task.id"
                cols="12"
                md="4"
                sm="6"
                class="mt-4">
                <v-card class="pt-4 pl-4 pr-4 ma-2 card-item">
                    <v-menu offset-y>
                        <template v-slot:activator="{ on, attrs }">
                            <v-btn
                                small
                                absolute
                                top
                                icon
                                right
                                color="grey"
                                v-bind="attrs"
                                v-on="on">
                                <v-icon>
                                    mdi-cog
                                </v-icon>
                            </v-btn>
                        </template>
                        <v-list>
                            <v-list-item link>
                                <!-- Show the Edit Task Name Dialog -->
                                <v-dialog
                                    v-model="dialog"
                                    width="500">
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-list-item-title
                                                v-bind="attrs"
                                                v-on="on"
                                                @click="setTaskName(task.task_name)"
                                            >
                                            <v-icon>mdi-pencil</v-icon> Edit
                                        </v-list-item-title>
                                    </template>

                                    <v-card>
                                        <v-card-title class="headline">
                                            Edit Task Name
                                        </v-card-title>

                                        <v-card-text>
                                            <v-text-field
                                                label="Task Name*"
                                                required
                                                v-model="task_name"
                                                >
                                            </v-text-field>
                                        </v-card-text>

                                        <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn
                                            color="primary"
                                            text
                                            @click="updateTask(task.id, task_name)">
                                            UPDATE
                                        </v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-dialog>
                            </v-list-item>

                            <v-list-item link>
                                <v-list-item-title @click="deleteTask(task.id)"><v-icon>mdi-delete</v-icon> Delete</v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>

                    <div @click="clickItem(task.id, task.task_name)">
                        <v-card-text>
                            <h2 class="text--secondary">{{ task.task_name }}</h2>
                        </v-card-text>
                        <v-card-actions class="d-flex flex-row-reverse">
                            <h5 class="grey--text">{{ task.created_at}}</h5>
                            <div class="badge">
                                <v-badge
                                    :content="task.count_cards > 0 ? task.count_cards : '0'"
                                    color="grey"
                                    inline
                                    class="mr-5">
                                    <v-icon>mdi-format-list-bulleted-square</v-icon>
                                </v-badge>
                                <v-badge
                                    :content="task.count_complete > 0 ? task.count_complete : '0'"
                                    color="blue"
                                    inline
                                    class="mr-5">
                                <v-icon>mdi-playlist-check</v-icon>
                                </v-badge>
                            </div>
                        </v-card-actions>
                    </div>
                </v-card>
            </v-col>

        </v-row>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tasks: [],
                dialog: false,
                task_name: null,
            }
        },
        created() {
            this.fetchTasks()

            EventBus.$on('newTask', () => {
                this.fetchTasks()
            })
        },
        methods: {
            fetchTasks() {
                axios.get('/api/task')
                    .then(({data}) => {
                        this.tasks = data.data
                    })
                    .catch(error => console.log(error))
            },
            clickItem(task_id, name) {
                EventBus.$emit('showCard', task_id, name);
            },
            setTaskName(name) {
                this.task_name = name
            },
            updateTask(id, name) {
                axios.put(`api/task/${id}`, {
                        task_name: name
                    })
                    .then(data => {
                        this.dialog = false
                        this.fetchTasks()
                    })
                    .catch(error => console.log(error))
            },
            deleteTask(id) {
                axios.delete(`api/task/${id}`)
                    .then(data => {
                        this.fetchTasks()
                    })
                    .catch(error => console.log(error))
            }
        }
    }
</script>

<style scoped>
    .badge {
        margin-right: 20%;
    }
    .card-item:hover {
        background-color: #F5F5F5;
        cursor: pointer;
    }
    .v-speed-dial {
        position: absolute;
    }
</style>
