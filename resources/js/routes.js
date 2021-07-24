// Dependencies
import Vue from "vue";
import VueRouter from "vue-router";

// Components from routes
import Home from "./pages/Home.vue";
// Components from routes
import AdvancedSearch from "./pages/AdvancedSearch.vue";
import Details from "./pages/Details.vue";

// Router registration
Vue.use(VueRouter);

// App routes
const router = new VueRouter({
    mode: "history",
    linkExactActiveClass: "active",
    routes: [
        {
            path: "/",
            name: "home",
            props: true,
            component: Home
        },
        {
            path: "/advancedsearch",
            name: "advancedsearch",
            props: true,
            component: AdvancedSearch
        },
        {
            path: "/details/:slug",
            name: "apartment-details",
            props: true,
            component: Details
        }
    ]
});

export default router;
