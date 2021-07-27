<template>
    <div class="container">
        <h2 class="mt-5 mb-3 title">Featured Apartments</h2>
        <div class="container d-flex flex-wrap mt-3 mb-5">
            <div
                v-for="(apartment, key) in apartmentSponsored"
                :key="key"
                class="card mt-4 cards"
                style="width: 18rem"
            >
                <div class="box-img">
                    <img
                        class="card-img-top"
                        :src="apartment.img_path"
                        alt="Card image cap"
                    />
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ apartment.title }}</h5>
                    <h6 class="card-title">
                        <i class="fas fa-map-marker-alt mr-1"></i
                        >{{ apartment.address }}
                    </h6>
                    <p class="card-text"></p>
                    <div class="d-flex justify-content-center">
                        <router-link
                            :to="{
                                name: 'apartment-details',
                                params: {
                                    slug: apartment.slug,
                                    latitude: apartment.latitude,
                                    longitude: apartment.longitude,
                                    currentRoute: 'home'
                                }
                            }"
                            class="btn btn-details"
                        >
                            View more
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

        <!-- <h2 class="title">Our Cities</h2> -->
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "Home",
    data() {
        return {
            apartmentSponsored: []
        };
    },
    created() {
        this.getApartmentsSposored();
    },
    methods: {
        getApartmentsSposored() {
            axios
                .get("http://127.0.0.1:8000/api/sponsorship")
                .then(result => {
                    this.apartmentSponsored = result.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>

<style scoped lang="scss">
.title {
    letter-spacing: 1px;
    font-weight: 700;
}
.text-white {
    color: #fff;
    text-shadow: 1px 0px 3px #000;
}

.box-img {
    height: 200px;
    width: 100%;
    overflow: hidden;
    img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: bottom;
        border-radius: 20px 20px 0 0;
    }
}

.cards {
    border-radius: 20px;
    flex-basis: calc(100% / 3 - 20px);
    margin: 0 10px;
    transition: all 0.3s;
    &:hover {
        transform: scale(1.1);
    }
}

.btn-details {
    background: #ff385c;
    outline: none;
    color: #fff;
    border-radius: 25px;
    border: 1px solid transparent;
    transition: color 0.3s, background-color 0.4s, border-color 0.4s;
    &:hover {
        color: #ff385c;
        border-color: #ff385c;
        background: #fff;
    }
}
</style>
