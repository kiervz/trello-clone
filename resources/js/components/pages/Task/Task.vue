<template>
    <div>
        <h2>List of Tasks</h2>
        <TaskItem />
    </div>
</template>
<script>
    import TaskItem from './TaskItem'
    export default {
        components: { TaskItem },
    }
</script>
