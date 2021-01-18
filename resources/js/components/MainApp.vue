<template>
    <v-app>
        <app-header></app-header>
        <router-view></router-view>
    </v-app>
</template>

<script>
    import AppHeader from './AppHeader'
    export default {
        components: { AppHeader },

    }
</script>
