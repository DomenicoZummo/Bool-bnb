<template>
    <div>
            <h1 class="text-center my-3">Appartamenti sponsorizzati</h1>
        <div class="container d-flex flex-wrap justify-content-between mt-3">
            <div
                v-for="(apartment, key) in apartmentSponsored"
                :key="key"
                class="card mt-4"
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
                    <p class="card-text"></p>
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
                        class="btn btn-primary"
                    >
                        View more
                    </router-link>
                </div>
            </div>
        </div>
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
 .box-img {
        height: 150px;
        width: 100%;
        object-fit: cover;
        object-position: center;
    }
</style>
