<template>
    <div>
        <v-text-field
            label="Add Card*"
            required
            class="mr-3"
            v-model="name"
            @keydown.enter="add(name)">
        </v-text-field>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                name: null,
            }
        },
        methods: {
            add(name) {
                if (!name) {
                    return;
                }
                this.$emit('add', name);
                this.name = null
            }
        }
    }
</script>
