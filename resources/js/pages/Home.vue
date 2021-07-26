<template>
    <div class="full-screen">
            <h1 class="text-center my-3">Appartamenti sponsorizzati</h1>
        <div class="container d-flex flex-wrap">
            <div v-for="(apartment,key) in apartmentSponsored" :key="key"
             class="card m-3" style="width: 18rem;">
                <img class="card-img-top" :src="apartment.img_path" alt="Card image cap">
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
import axios from 'axios';
export default {
    name: "Home",
    data(){
        return {
            apartmentSponsored: [],
        }
    },
    created(){
        this.getApartmentsSposored();
    },
    methods:{
        getApartmentsSposored(){

            axios.get('http://127.0.0.1:8000/api/sponsorship')
            .then(result => {
                this.apartmentSponsored = result.data;
                console.log(result.data);
            } )
            .catch(error =>{
                console.log(error);
            });
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
.text-white {
    color: #fff;
    text-shadow: 1px 0px 3px #000;
}
</style>
