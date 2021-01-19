<template>
    <div>
        <v-row no-gutters>
            <v-col
                v-for="todo in todos"
                :key="todo.id"
                cols="12"
                md="4"
                sm="6">
                <v-card
                    @click="clickItem(todo.id)"
                    class="pt-4 pl-4 pr-4 ma-2 card-item"
                    >
                    <v-card-text>
                        <h2 class="text--secondary">{{ todo.name }}</h2>
                    </v-card-text>
                    <v-card-actions class="d-flex flex-row-reverse">
                        <h5 class="grey--text">{{ todo.created_at}}</h5>
                         <div class="badge">
                            <v-badge
                                :content="todo.count_cards > 0 ? todo.count_cards : '0'"
                                color="grey"
                                inline
                                class="mr-5">
                                <v-icon>mdi-format-list-bulleted-square</v-icon>
                            </v-badge>
                             <v-badge
                                :content="todo.count_complete > 0 ? todo.count_complete : '0'"
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
                todos: [],
            }
        },
        created() {
            this.fetchTodos()
        },
        methods: {
            fetchTodos() {
                axios.get('/api/task')
                    .then(({data}) => {
                        this.todos = data.data
                    })
                    .catch(error => {
                        console.log(error);
                    })
            },
            clickItem(task_id) {
                EventBus.$emit('showCard', task_id);
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
