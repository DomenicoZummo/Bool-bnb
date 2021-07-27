<template>
    <div class="padding-header-fixed">
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
        <main>
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

// .padding-header-fixed {
//     padding-top: 56px;
// }

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

* {
    scrollbar-width: thin;
    scrollbar-color: #212529 #212529a6;
}

.btn-custom {
    background-color: #ff385c;
    padding: 5px 8px;
    border-radius: 50%;
    color: #fff;
    border: 1px solid transparent;
    transition: all 0.3s;
    text-decoration: none;
    position: relative;
    left: -70px;
    bottom: 1px;

    &:hover {
        background-color: #fff;
        color: #ff385c;
        border-color: #ff385c;
        text-decoration: none;
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
</style>
