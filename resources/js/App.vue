<template>
    <div class="container pt-1">
        <!-- Header -->
        <Header />

        <SearchBox
            class="mb-3.."
            v-show="
                this.$route.name == 'advancedsearch' ||
                    this.$route.name == 'home'
            "
            @getApartmentFiltered="getApartmentFiltered"
        />

        <!-- Main -->
        <main class="d-flex">
            <router-view :apartments="apartmentsFilter"> </router-view>
            <Maps
                class="my-3"
                v-show="this.$route.name == 'apartment-details'"
            />
        </main>
        <!-- Footer -->
        <Footer />
    </div>
</template>

<script>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import SearchBox from "./components/SearchBox.vue";
import Maps from "./components/Maps.vue";

export default {
    name: "App",
    components: {
        Header,
        Footer,
        SearchBox,
        Maps
    },
    data() {
        return {
            apartmentsFilter: []
        };
    },

    methods: {
        getApartmentFiltered(e) {
            this.apartmentsFilter = e;
        }
    }
};
</script>

<style lang="scss">
@import "~bootstrap/dist/css/bootstrap.css";


/* width */
::-webkit-scrollbar {
    width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1;
     border-radius: 20px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: rgb(45, 109, 173);
    border-radius: 20px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: dodgerblue;
}

#searchbox-front{
    margin:0 20px 0 0 ;
    width: 500px;
    .tt-search-box{
        border-radius: 50px;
    }
    .tt-search-box-input-container{
        border-color: transparent;
        border-radius: 50px;
    }
}

body.body{
    min-height: 100vh;
    max-width: 100vw;
    background-image: url('https://images-ext-2.discordapp.net/external/bRQb20q50e53VH1ZTuDbP1qeWhkZE2AnFkARtEDwfIA/https/wallpaperaccess.com/full/1431622.jpg?width=1191&height=670');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: top;
    h1{
    color: #fff;
    text-shadow: 1px 0px 3px #000;
}
}
</style>
