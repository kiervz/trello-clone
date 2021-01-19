<template>
    <v-app>
        <app-header></app-header>
        <br><br>
        <v-container>
            <router-view></router-view>
        </v-container>
    </v-app>
</template>

<script>
    import AppHeader from './AppHeader'
    export default {
        components: { AppHeader },
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
