<template>
    <div class="full-screen">
        <div class="container">
            <h1>Home</h1>
            <SearchBoxVue
                :searchLat="searchLat"
                :searchLng="searchLng"
                :searchAddress="searchAddress"
            />
        </div>
    </div>
</template>

<script>
import SearchBoxVue from "../components/SearchBoxVue.vue";
import tt from "@tomtom-international/web-sdk-maps";
import { services } from "@tomtom-international/web-sdk-services";
import SearchBox from "@tomtom-international/web-sdk-plugin-searchbox";

export default {
    name: "Home",
    components: {
        SearchBoxVue
    },
    data() {
        return {
            service: tt.setProductInfo("bool", "version2"),
            searchLat: null,
            searchLng: null,
            searchAddress: null
        };
    },
    mounted() {
        this.getSearchBox();
    },
    methods: {
        getSearchBox() {
            var options = {
                searchOptions: {
                    key: "gKIZzIyagJPsNGDOLL9WGenkQlFeapDb",
                    language: "it-IT",
                    limit: 5
                }
            };

            const ttSearchBox = new SearchBox(services, options);
            var searchBoxHTML = ttSearchBox.getSearchBoxHTML();
            document.getElementById("searchbox-front").prepend(searchBoxHTML);
            ttSearchBox.on(
                "tomtom.searchbox.resultselected",
                this.handleResultSelection
            );
        },

        handleResultSelection(event) {
            var result = event.data.result;
            // console.log("event", event);
            // console.log("eventresult", result.position.lat);
            // console.log("eventresult", result.position.lng);
            this.searchLat = result.position.lat;
            this.searchLng = result.position.lng;
            this.searchAddress = result.address.freeformAddress;
            console.log("searchlat", this.searchLat);
            console.log("searchlng", this.searchLng);
            console.log("searchaddress", this.searchAddress);
            if (result.type === "category" || result.type === "brand") {
                return;
            }
        }
    }
};
</script>

<style scoped lang="scss">
.full-screen {
    height: 1000px;
    width: 100vw;
    background-image: url("https://images-ext-2.discordapp.net/external/bRQb20q50e53VH1ZTuDbP1qeWhkZE2AnFkARtEDwfIA/https/wallpaperaccess.com/full/1431622.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
}
</style>
