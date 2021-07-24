<template>
    <div class="padding-header-fixed">
        <!-- Header -->
        <Header />

        <!-- <SearchBoxVue
            v-show="
                this.$route.name == 'advancedsearch' ||
                    this.$route.name == 'home'
            "
            @getApartmentFiltered="getApartmentFiltered"
        /> -->

        <!-- Main -->
        <main>
            <router-view> </router-view>
            <Maps
                class="my-3"
                v-show="this.$route.name == 'apartment-details-fake'"
            />
        </main>
        <!-- Footer -->
        <Footer />
    </div>
</template>

<script>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import SearchBoxVue from "./components/SearchBoxVue.vue";
import Maps from "./components/Maps.vue";

export default {
    name: "App",
    components: {
        Header,
        Footer,
        SearchBoxVue,
        Maps
    },
    data() {
        return {
            // apartmentsFilter: []
        };
    },
    methods: {
        // getApartmentFiltered(e) {
        //     this.apartmentsFilter = e;
        // }
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

.padding-header-fixed {
    padding-top: 56px;
}

#searchbox-front {
    margin: 0 20px 0 0;
    width: 500px;
    .tt-search-box {
        border-radius: 50px;
    }
    .tt-search-box-input-container {
        // border-color: transparent;
        border-radius: 50px;
    }
}
</style>
