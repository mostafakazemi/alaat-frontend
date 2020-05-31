import VueRouter from 'vue-router';

import Blocks from "./components/Blocks";
import SpecialBlock from "./components/SpecialBlock";

let mode = 'history';
let routes= [
    {
        path:'/',
        components:{
            default: Blocks
        }
    },
    {
        path:'/:blockId',
        components:{
            default: SpecialBlock
        }
    },
];

export default new VueRouter({
    routes,
    mode,
})
