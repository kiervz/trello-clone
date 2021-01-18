<template>
    <div>
        <br><br><br><br>
        <h1>Gago</h1>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        created() {
            EventBus.$on('logout', () => {
                User.logOut();
            })
        }
    }
</script>
