require('./bootstrap');

import Vue from 'vue';

//////////////////////////////////////////////////////
import VueRouter from 'vue-router'

Vue.use(VueRouter)

//////////////////////////////////////////////////////
import InfiniteLoading from 'vue-infinite-loading';

Vue.use(InfiniteLoading, { /* options */ });

//////////////////////////////////////////////////////
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

//////////////////////////////////////////////////////
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

//////////////////////////////////////////////////////
import vueTopprogress from 'vue-top-progress'

Vue.use(vueTopprogress)

//////////////////////////////////////////////////////
import ScrollLoader from 'vue-scroll-loader'

Vue.use(ScrollLoader)

//////////////////////////////////////////////////////


Vue.component('block', require('../js/components/Block').default);

import router from './router'
Vue.router = router;

new Vue({
    el: '#app',
    router
})
