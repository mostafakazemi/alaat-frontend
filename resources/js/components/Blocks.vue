<template>
    <div>
        <vue-topprogress ref="topProgress"/>

        <div class="text-center fixed-top bg-light py-2">
            <b-badge variant="primary">{{ blocks.length }}</b-badge>
            تعداد بلاک‌ها
        </div>

        <div v-for="(block, index) in blocks">
            <block :key="index" :block-id="block.id"/>
        </div>

        <infinite-loading @infinite="infiniteHandler"></infinite-loading>
    </div>
</template>

<script>
    export default {
        name: "Blocks",
        data() {
            return {
                blockId: parseInt(this.$route.params.blockId),
                blocks: [],
                page: 1,
            }
        },
        methods: {
            infiniteHandler($state) {
                this.$refs.topProgress.start()
                axios.get('blocks-api', {
                    params: {
                        page: this.page,
                    },
                }).then(({data}) => {
                    if (data.data.length) {
                        this.page += 1;
                        this.blocks.push(...data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                    this.$refs.topProgress.done()
                });
            },
        }
    }
</script>

<style scoped>

</style>
