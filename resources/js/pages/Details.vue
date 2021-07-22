<template>
    <div class="container" v-if="apartment">
        <!-- Back button -->
        <router-link
            :to="{
                name: 'advancedsearch'
            }"
            class="btn btn-danger my-4"
        >
            Back
        </router-link>

        <!-- Title -->
        <h2 class="my-3 mb-5">
            <i class="fas fa-house-user"></i> {{ apartment.title }}
        </h2>

        <div class="d-flex mb-4 justify-content-around">
            <!-- Rooms -->
            <div><strong>Camere:</strong> {{ apartment.rooms }}</div>

            <!-- Beds -->
            <div>
                <strong><i class="fas fa-bed"></i></strong> {{ apartment.beds }}
            </div>

            <!-- Floor -->
            <div><strong>Piano:</strong> {{ apartment.floor }}</div>

            <!-- Bathrooms -->
            <div>
                <strong><i class="fas fa-toilet"></i></strong>
                {{ apartment.bathrooms }}
            </div>

            <!-- Mq -->
            <div v-if="apartment.square_meters">
                <strong>Mq:</strong> {{ apartment.square_meters }} mq
            </div>
        </div>

        <!-- Img -->
        <div class="img-wrapper">
            <img :src="apartment.img_path" :alt="apartment.title" />
        </div>

        <!-- Services -->
        <div class="d-flex">
            <div
                v-for="(service, index) in apartment.services"
                :key="index"
                class="d-flex badge badge-primary p-2 m-2"
            >
                {{ service.name }}
            </div>
        </div>

        <!-- Send Message -->
        <input
            v-show="this.$route.name == 'apartment-details'"
            @click="clickMessage"
            class="mt-4 btn btn-warning"
            type="button"
            value="Invia un messaggio"
        />
        <div v-show="clickMessageStatus" class="searchFilter">
            <div class="box-search py-2">
                <Message class="p-5" :apartment="apartment" />
                <span class="close" @click="clickMessage">Close</span>
            </div>
        </div>
    </div>
</template>

<script>
import Message from "../components/Message.vue";
import tt from "@tomtom-international/web-sdk-maps";

export default {
    name: "Details",
    components: {
        Message
    },
    data() {
        return {
            apartment: null,
            clickMessageStatus: false,
            marker: "",
            map: "",
            service: tt.setProductInfo("bool", "version2")
        };
    },
    created() {
        this.getApartmentDetails();
    },
    methods: {
        getApartmentDetails() {
            axios
                .get(
                    `http://127.0.0.1:8000/api/apartments/${this.$route.params.slug}`
                )
                .then(res => {
                    this.apartment = res.data;
                    this.map = tt.map({
                        key: "gHNQlC91c7IVQOAYndiQCxDEAX09ZzVj",
                        container: "map",

                        center: [res.data.longitude, res.data.latitude],
                        zoom: 15
                    });
                    this.marker = new tt.Marker()
                        .setLngLat([res.data.longitude, res.data.latitude])
                        .addTo(this.map);
                })
                .catch(err => {
                    console.log(err);
                });
        },

        // Open/Close the messages menu
        clickMessage() {
            this.clickMessageStatus = !this.clickMessageStatus;
        }
    }
};
</script>

<style scoped lang="scss">
#map {
    width: 50vw;
    height: 50vh;
}

.img-wrapper {
    width: 500px;
    img {
        width: 100%;
    }
}

.searchFilter {
    display: flex;
    position: absolute;
    z-index: 10;
    background: rgba(#000000, 0.3);
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    justify-content: center;
    align-items: center;

    .box-search {
        position: relative;
        width: 50vw;
        height: 80vh;
        background: #fff;
        color: #000;
        overflow-y: auto;
        transform: scale(0.1);
        opacity: 0;
        animation: box-search-in 0.3s forwards;

        @keyframes box-search-in {
            0% {
                transform: scale(0.1);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .close {
            color: red;
            position: absolute;
            top: 30px;
            right: 60px;
            font-size: 20px;
            cursor: pointer;
        }
    }
}
</style>
