<template>
    <div>
        <v-text-field
            label="Add Card*"
            required
            class="mr-3"
            v-model="card_name"
            @keydown.enter="add(card_name)">
        </v-text-field>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                card_name: null,
            }
        },
        methods: {
            add(name) {
                if (!name) {
                    return;
                }
                this.$emit('add', name);
                this.card_name = null
            }
        }
    }
</script>
