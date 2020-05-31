<template>
    <div>
        <div class="d-flex mw-100 mx-1 overflow-auto">
            <div v-for="(item, index) in items" :key="index" class="border d-flex mx-1" ref="items">
                <div v-if="selectedBlock!==index" class="max-min-width-200">
                    <b-media>
                        <template v-slot:aside>
                            <img src="https://via.placeholder.com/75" alt="Media Aside" @click="fullWidth(index)"
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
                            <img src="https://via.placeholder.com/125" alt="Media Aside" @click="fullWidth(index)"
                                 style="cursor: pointer">
                        </template>

                        <div class="d-flex justify-content-around">
                            <small>{{ item.author_name }}</small>
                            <b-button-close class="align-self-start" @click="selectedBlock=''"/>
                        </div>
                        <div><small>{{ item.title }}</small></div>
                        <small>{{ item.content }}</small>
                    </b-media>
                </div>
            </div>
            33
            <infinite-loading @infinite="infiniteHandler"/>
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
                selectedBlock: ''
            }
        },
        methods: {
            infiniteHandler($state) {
                axios.get('/items-api/' + this.blockId, {
                    params: {
                        page: this.page,
                    },
                }).then(({data}) => {
                    if (data.data.length) {
                        this.page += 1;
                        this.items.push(...data.data);
                        $state.loaded();
                    } else {
                        $state.complete();
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
    .max-min-width-200 {
        min-width: 200px;
        max-width: 200px;
    }

    .full-width {
        min-width: 100% !important;
        max-width: 100% !important;
    }
</style>
