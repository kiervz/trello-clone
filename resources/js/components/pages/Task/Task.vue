<template>
    <div>
        <div v-if="is_card">
            <h2>{{ task_name }} List</h2>
            <Card :task_id="task_id" />
        </div>
        <div v-else>
            <h2>Tasks</h2>
            <TaskItem />
        </div>
    </div>
</template>
<script>
    import TaskItem from './TaskItem'
    import Card from '../Card/Card'
    export default {
        components: { TaskItem, Card },
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
            }
        },
        created() {
            this.listen()
        }
    }
</script>
