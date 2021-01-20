<template>
    <v-container>
        <v-alert
            dense
            outlined
            type="error"
            v-if="error"
            >
            {{ error }}
        </v-alert>
        <AddCard @add="addNewCard" @update="updateCard" />
        <v-card @dblclick="editCard(card.id, card)" v-for="card in cards" :key="card.id" class="mb-4">
            <v-list-item-content class="pr-4 pl-4 pa-0">
                <v-flex md1 sm1 xs1>
                    <v-checkbox
                        v-model="card.is_complete"
                        @change="markComplete(card.id, card.is_complete)">
                    </v-checkbox>
                </v-flex>
                <v-flex md10 sm10 xs10 class="pl-2" :class="card.is_complete ? 'is-complete' : ''">
                    <h4>{{ card.card_name }}</h4>
                </v-flex>
                <v-flex md1 sm1 xs1>
                    <div class="d-flex">
                        <v-btn icon small @click="deleteCard(card.id)">
                            <v-icon color="red">mdi-delete</v-icon>
                        </v-btn>
                    </div>
                </v-flex>
            </v-list-item-content>
        </v-card>
    </v-container>
</template>

<script>
    import AddCard from './AddCard'
    export default {
        props: ['task_id'],
        components: { AddCard },
        data() {
            return {
                cards: {},
                form: {
                    name: null,
                },
                is_complete_temp: null,
                error: null,
            }
        },
        created() {
            this.fetchCards()
        },
        methods: {
            fetchCards() {
                axios.get(`api/card/${this.task_id}`)
                    .then(({data}) => {
                        this.cards = data.cards
                    })
                    .catch(error => console.log(error))
            },
            markComplete(id, is_complete) {
                axios.put(`api/card/${id}/${this.task_id}/update`, {
                        is_complete: is_complete
                    })
                    .then(data => {
                        this.cards.is_complete = is_complete
                    })
                    .catch(error => console.log(error))
            },
            addNewCard(name) {
                axios.post(`api/card/${this.task_id}`, {
                        card_name: name,
                        task_id: this.task_id
                    })
                    .then(data => {
                        this.error = null
                        this.fetchCards()
                    })
                    .catch(error => {
                        this.error = error.response.data.errors.card_name[0]
                    })
            },
            updateCard(id, name) {
                axios.put(`api/card/${id}/${this.task_id}`, {
                        card_name: name
                    })
                    .then(data => this.fetchCards())
                    .catch(error => console.log(error))
            },
            editCard(id, name) {
                EventBus.$emit('editCard', id, name.card_name);
            },
            deleteCard(id) {
                axios.delete(`api/card/${id}/${this.task_id}`)
                    .then(data => {
                        this.fetchCards()
                    })
                    .catch(error => console.log(error))
            }
        }
    }
</script>

<style scoped>
    .is-complete {
        text-decoration: line-through;
        color: grey;
    }
</style>
