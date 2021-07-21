<template>
    <div class="container" v-if="apartment">
        <h2>{{ apartment.title }}</h2>
        <h4>Camere: {{ apartment.rooms }}</h4>
        <h4>Letti: {{ apartment.beds }}</h4>
        <img :src="apartment.img_path" :alt="apartment.title" />
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

export default {
    name: "Details",
    components: {
        Message
    },
    data() {
        return {
            apartment: null,
            clickMessageStatus: false
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
                    console.log(
                        `http://127.0.0.1:8000/api/apartments/${this.$route.params.slug}`
                    );
                    this.apartment = res.data;
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
.container {
    width: 100%;
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
        width: 1000px;
        height: 800px;
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
