<template>
    <div>
        <v-list-item-content>
            <v-flex md11 sm10 xs9>
                <v-text-field
                    label="Add Card*"
                    required
                    class="mr-3"
                    v-model="card_name">
                </v-text-field>
            </v-flex>
            <v-flex md1 sm2 xs3>
                <div class="d-flex">
                    <v-btn
                        elevation="4"
                        small
                        dark
                        color="primary"
                        fab
                        @click="!is_edit ? add(card_name) : update(card_name)">
                        <v-icon v-if="!is_edit">mdi-plus</v-icon>
                        <v-icon v-else>mdi-content-save</v-icon>
                    </v-btn>
                    <v-btn
                        elevation="4"
                        small
                        fab
                        class="ml-2"
                        v-if="is_edit"
                        @click="close">
                        <v-icon>mdi-close</v-icon>
                    </v-btn>
                </div>
            </v-flex>
        </v-list-item-content>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                card_name: null,
                card_id: null,
                is_edit: false,
            }
        },
        created() {
            EventBus.$on('editCard', (id, name) => {
                this.is_edit = true
                this.card_id = id
                this.card_name = name
            })
        },
        methods: {
            add(name) {
                if (!name) {
                    return;
                }
                this.$emit('add', name);
                this.card_name = null
            },
            update(name) {
                if (!name) {
                    this.is_edit = false
                    return
                }
                this.$emit('update', this.card_id, name);
                this.close()
            },
            close() {
                this.card_name = null
                this.card_id = null
                this.is_edit = false
            }
        }
    }
</script>
