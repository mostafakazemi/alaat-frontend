<template>
    <div>
        <div v-for="block in blocks">
            {{ block.name }}
        </div>
    </div>
</template>

<script>
    export default {
        name: "Blocks",
        data() {
            return {
                blocks: []
            }
        },
        mounted() {
            this.axios.get('blocks-api').then((response) => {
                this.blocks = response.data.data;
            })
        }
    }
</script>

<style scoped>

</style>
