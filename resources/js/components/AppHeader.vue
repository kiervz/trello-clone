<template>
    <v-container>
        <v-app-bar app dense dark fixed>
            <v-app-bar-nav-icon @click="drawer = !drawer" class="hidden-md-and-up"></v-app-bar-nav-icon>
            <v-toolbar-title>
                <router-link to="/" class="text-decoration-none white--text">Trello</router-link>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-sm-and-down" v-for="item in items" :key="item.title">
                <v-btn text
                    :to="item.to"
                    v-if="item.show"
                    class="text-decoration-none"
                >{{ item.title }}</v-btn>
            </v-toolbar-items>

            <v-menu bottom min-width="200px" rounded offset-y  v-if="loggedIn">
                <template v-slot:activator="{ on }">
                    <v-btn icon x-medium v-on="on">
                        <v-avatar color="primary" size="35">
                            <v-icon>mdi-account</v-icon>
                        </v-avatar>
                    </v-btn>
                </template>
                <v-card>
                    <v-list>
                        <v-list-item-group>
                            <v-list-item>
                                <v-list-item-content>
                                    <router-link to="/" class="text-decoration-none black--text">
                                        <v-icon>mdi-account</v-icon> {{ loggedInUser }}
                                    </router-link>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-content class="text-center">
                                    <router-link :to="{ path: '/logout' }" class="text-decoration-none black--text">
                                        <v-icon>mdi-logout</v-icon> Logout
                                    </router-link>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-item-group>
                    </v-list>
                </v-card>
            </v-menu>
        </v-app-bar>
        <v-navigation-drawer
            v-model="drawer"
            fixed
            dark
            temporary>
            <div v-for="(item, index) in items" :key="index" >
                <v-btn text block :to="item.to" v-if="item.show" class="text-decoration-none">{{ item.title }}</v-btn>
            </div>
        </v-navigation-drawer>
    </v-container>
</template>
<script>
    export default {
        data() {
            return {
                items: [
                    { title: 'Home', to: '/home', show: User.loggedIn() },
                    { title: 'Task', to: '/task', show: User.loggedIn() },
                    { title: 'Login', to: '/login', show: !User.loggedIn() },
                    { title: 'Register', to: '/register', show: !User.loggedIn() },
                ],
                loggedIn: User.loggedIn(),
                loggedInUser: User.name(),
                drawer: false,
            }
        },
    }
</script>
