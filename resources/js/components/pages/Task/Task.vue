<template>
    <div>
        <div v-if="is_card">
            <v-list-item-content>
                <v-flex md11 sm10 xs9>
                    <h2 class="ml-3 mt-2">{{ task_name }} List</h2>
                </v-flex>
                <v-flex md1 sm2 xs3>
                    <v-btn @click="cancel">BACK</v-btn>
                </v-flex>
            </v-list-item-content>
            <Card :task_id="task_id" />
        </div>
        <div v-else>
            <AddTask />
            <TaskItem />
        </div>
    </div>
</template>
<script>
    import TaskItem from './TaskItem'
    import Card from '../Card/Card'
    import AddTask from './AddTask'

    export default {
        components: { TaskItem, Card, AddTask },
        data() {
            return {
                is_card: false,
                task_id: null,
                task_name: null,
            }
        },
        methods: {
            listen() {
                EventBus.$on('showCard', (task_id, name) => {
                    this.is_card = true
                    this.task_id = task_id
                    this.task_name = name
                });
            },
            cancel() {
                this.is_card = false
            },
        },
        created() {
            this.listen()
            this.cancel()
        }
    }
</script>
