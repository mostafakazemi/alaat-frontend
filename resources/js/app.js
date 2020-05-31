require('./bootstrap');

import Vue from 'vue';

//////////////////////////////////////////////////////
import InfiniteLoading from 'vue-infinite-loading';

Vue.use(InfiniteLoading, { /* options */ });

//////////////////////////////////////////////////////
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

//////////////////////////////////////////////////////







Vue.component('blocks', require('../js/components/Blocks').default);

new Vue({
    el: '#app',
})
