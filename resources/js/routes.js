// Dependencies
import Vue from 'vue';
import VueRouter from 'vue-router';

// Components from routes
import Home from './pages/Home.vue';


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
    ],
});

export default router ;