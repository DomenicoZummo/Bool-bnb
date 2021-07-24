<template>
    <div class="full-screen">
        <div class="container">
            <h1>Home</h1>
            <SearchBoxVue />
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
            service: tt.setProductInfo("bool", "version2")
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
            var searchBox = new SearchBox(services, options);
            // var searchBoxHTML = searchBox.getSearchBoxHTML();
            // document.getElementById("searchbox-front").prepend(searchBoxHTML);
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
