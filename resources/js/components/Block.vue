<template>
    <div>
        <div class="mx-auto my-5 overflow-auto border p-1 d-flex w-100">
            <div v-for="(item, index) in items" :key="index" class="border mx-1" ref="items">
                <div v-if="selectedBlock!==index" class="max-min-width-300">
                    <b-media>
                        <template v-slot:aside>
                            <img src="https://via.placeholder.com/75" @click="fullWidth(index)"
                                 style="cursor: pointer">
                        </template>

                        <div><small>{{ item.author_name }}</small></div>
                        <div><small>{{ item.title }}</small></div>
                    </b-media>
                    <div class="overflow-hidden" style="height: 50px; max-height: 50px">
                        <small>{{ item.content }}</small>
                    </div>
                </div>

                <div v-else class="full-width">
                    <b-media>
                        <template v-slot:aside>
                            <img src="https://via.placeholder.com/125" style="cursor: pointer">
                        </template>

                        <div class="d-flex justify-content-between">
                            <small>{{ item.author_name }}</small>
                            <b-button-close class="align-self-start" @click="selectedBlock=''"/>
                        </div>
                        <div><small>{{ item.title }}</small></div>
                        <small>{{ item.content }}</small>
                    </b-media>
                </div>
            </div>

            <div class="max-min-width-300">
                <scroll-loader :loader-method="getImagesInfo" v-if="loadMore" :loader-enable="loadMore"/>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "Block",
        props: ['blockId'],
        data() {
            return {
                items: [],
                page: 1,
                selectedBlock: '',
                loadMore: true,
            }
        },
        methods: {
            getImagesInfo() {
                axios.get('/items-api/' + this.blockId, {
                    params: {
                        page: this.page++,
                    }
                }).then(({data}) => {
                    if (data.data.length) {
                        this.page += 1;
                        this.items.push(...data.data);
                    } else {
                        this.loadMore = false;
                    }
                });
            },
            fullWidth(index) {
                this.selectedBlock = index;
            }
        }
    }
</script>

<style scoped>
    .max-min-width-300 {
        min-width: 300px;
        max-width: 300px;
    }

    .full-width {
        width: 98vw !important;
    }
</style>
