<template>
    <div>
        <vue-topprogress ref="topProgress"/>

        <div class="text-center fixed-top bg-light py-2">
            <b-badge variant="primary">{{ blocks.length }}</b-badge>
            تعداد بلاک‌ها
        </div>

        <div>
            <infinite-loading v-if="this.page.prev>0" direction="top" @infinite="infiniteHandlerUp"/>

            <div class="mx-auto my-5 py-5 col-12 border" v-for="(block, index) in blocks">
                <h1>{{ block.id }}</h1>
<!--                            <block :key="index" :block-id="block.id"/>-->
            </div>

            <infinite-loading v-if="this.page.next!==''" @infinite="infiniteHandlerDown"/>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Blocks",
        data() {
            return {
                blockId: parseInt(this.$route.params.blockId),
                blocks: [],
                page: {
                    prev:'',
                    next:'',
                },
            }
        },
        beforeMount() {
            axios.get('get-block-page/' + this.blockId).then((response) => {
                this.page.prev = response.data;
                this.page.next = this.page.prev+1;
            });
        },
        methods: {
            infiniteHandlerUp($state) {
                this.$refs.topProgress.start()
                axios.get('blocks-api/' + this.page.prev).then(({data}) => {
                    if (data) {
                        this.page.prev -= 1;
                        this.blocks.unshift(...data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                    this.$refs.topProgress.done()
                });
            },
            infiniteHandlerDown($state) {
                this.$refs.topProgress.start()
                axios.get('blocks-api/' + this.page.next).then(({data}) => {
                    if (data) {
                        this.page.next += 1;
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
