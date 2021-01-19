<template>
    <div>
        <div v-if="is_card">
            <h2>Cards</h2>
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
            }
        },
        methods: {
            listen() {
                EventBus.$on('showCard', (task_id) => {
                    this.is_card = true
                    this.task_id = task_id
                });
            }
        },
        created() {
            this.listen()
        }
    }
</script>
