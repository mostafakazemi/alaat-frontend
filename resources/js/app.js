require('./bootstrap');

import Vue from 'vue';

Vue.component('blocks', require('../js/components/Blocks').default);

new Vue({
    el: '#app',
})
