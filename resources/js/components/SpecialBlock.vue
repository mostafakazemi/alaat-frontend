<template>
    <div>
        <vue-topprogress ref="topProgress"/>

        <div class="text-center fixed-top bg-light py-2">
            <b-badge variant="primary">{{ blocks.length }}</b-badge>
            تعداد بلاک‌ها
        </div>

<!--        <infinite-loading direction="top" @infinite="infiniteHandlerUp"></infinite-loading>-->

        <div class="mx-auto my-5 py-5 col-12 border" v-for="(block, index) in blocks">
            {{ block.id }}
            <!--            <block :key="index" :block-id="block.id"/>-->
        </div>

        <infinite-loading @infinite="infiniteHandlerDown"></infinite-loading>
    </div>
</template>

<script>
    export default {
        name: "Blocks",
        data() {
            return {
                blockId: parseInt(this.$route.params.blockId),
                blocks: [],
                page: '',
            }
        },
        beforeMount() {
            axios.get('get-block-page/' + this.blockId).then((response) => {
                this.page = response.data;
            });
        },
        methods: {
            infiniteHandlerUp($state) {
                this.$refs.topProgress.start()
                axios.get('blocks-api/' + this.page).then(({data}) => {
                    if (data) {
                        console.data
                        this.page -= 1;
                        this.blocks.push(...data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                    this.$refs.topProgress.done()
                });
            },
            infiniteHandlerDown($state) {
                this.$refs.topProgress.start()
                axios.get('blocks-api/' + this.page).then(({data}) => {
                    if (data) {
                        console.data
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
