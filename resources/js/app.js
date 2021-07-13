require("./bootstrap");

window.Vue = require("vue");
window.axios = require("axios");

// Vue main instance
import App from "./App.vue";

// Router
// import router from "./routes";

const root = new Vue({
    el: "#root",
    // router,
    render: h => h(App)
});