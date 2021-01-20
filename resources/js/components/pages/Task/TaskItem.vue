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
                                <v-list-item-title><v-icon>mdi-pencil</v-icon> Edit</v-list-item-title>
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
