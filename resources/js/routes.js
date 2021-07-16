// Dependencies
import Vue from 'vue';
import VueRouter from 'vue-router';

// Components from routes
import Home from './pages/Home.vue';
// Components from routes
import AdvancedSearch from './pages/AdvancedSearch.vue';


// Router registration 
Vue.use(VueRouter);

// App routes
const router = new VueRouter({
    mode:'history',
    linkActiveClass:'active',
    routes:[
        {
            path:'/',
            name:'home',
            component:Home,
        },
        {
            path:'/advancedsearch',
            name:'advancedsearch',
            component:AdvancedSearch,
        },
    ],
});

export default router ;