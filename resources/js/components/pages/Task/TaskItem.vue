<template>
    <div>
        <v-row no-gutters>
            <v-col
                v-for="task in tasks"
                :key="task.id"
                cols="12"
                md="4"
                sm="6">
                <v-card
                    @click="clickItem(task.id, task.task_name)"
                    class="pt-4 pl-4 pr-4 ma-2 card-item"
                    >
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
</style>
