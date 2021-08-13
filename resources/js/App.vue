<template>
    <div class="d-flex flex-column fake-body">
        <!-- Header -->
        <Header />

        <SearchBox
            v-show="
                this.$route.name == 'advancedsearch' ||
                    this.$route.name == 'home'
            "
            @getApartmentFiltered="getApartmentFiltered"
            @isLoading="getLoading"
        />

        <!-- Main -->
        <main class="flex-grow">
            <router-view :apartments="apartmentsFilter" :isLoading="isLoading">
            </router-view>
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
            apartmentsFilter: [],
            isLoading: ""
        };
    },

    methods: {
        getApartmentFiltered(e) {
            if (e != null && e.length > 0) {
                this.apartmentsFilter = e;
            } else {
                this.apartmentsFilter = [];
                this.isLoading = "No results";
            }
        },

        getLoading(string) {
            this.isLoading = string;
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
    background: #212529a6;
    border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #212529;
    border-radius: 10px;
}

#searchbox-front {
    margin: 0;
    width: 500px;
    .tt-search-box {
        border-radius: 50px;
    }
    .tt-search-box-input-container {
        // border-color: transparent;
        border-radius: 50px;
    }
}

* {
    scrollbar-width: thin;
    scrollbar-color: #212529 #212529a6;
}

.btn-custom {
    background-color: #ff385c;
    padding: 5px 9px;
    border-radius: 50%;
    border: 1px solid transparent;
    transition: all 0.4s;
    text-decoration: none;
    position: relative;
    left: -50px;
    bottom: 1px;
    cursor: pointer;

    &:hover {
        background-color: #fff;
        border-color: #ff385c;
    }

    a {
        color: #fff;
        text-decoration: none;
    }

    &:hover a {
        color: #ff385c;
    }
}

.btn-custom-white {
    background-color: #fff;
    padding: 5px 15px;
    border-radius: 50px;
    color: #ff385c;
    border: 1px solid transparent;
    font-weight: 500;
    transition: all 0.3s;
    text-decoration: none;

    &:hover {
        border-color: #ff385c;
        text-decoration: none;
    }
}

.tt-search-box-input-container {
    position: relative;
    div {
        svg {
            display: none;
        }
    }
}

#text-header {
    color: rgb(230, 222, 222);
    border: 2px solid transparent;
    margin: 0 5px;
    border-radius: 20px;

    &:hover {
        color: #fff;
    }
}

#text-header.active {
    color: #fff;
    border-bottom: 2px solid #fff;
}

.fake-body {
    min-height: 100vh;
}

.flex-grow {
    flex-grow: 1;
}
</style>
