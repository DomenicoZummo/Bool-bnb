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
        <!-- <h2 class="title my-4">Explore the surroundings</h2> -->
        <!-- <div class="box-dintorni d-flex flex-wrap mb-5">
           
                <div 
                class="col-xs-12 col-md-3 my-3 ">
                        <router-link class="d-flex align-items-center router"
                        :to="'advancedsearch'">
                            <div class="img-box mr-3 ">
                                <img src="https://a0.muscache.com/im/pictures/be4d3ba5-08d7-4afe-95a7-f2da6453886a.jpg" alt="">
                            </div>
                            <h5>Roma</h5>
                        </router-link>
                 </div>


                <div 
                class="col-xs-12 col-md-3 my-3 ">
                        <router-link class="d-flex align-items-center router"
                        :to="'advancedsearch'">
                            <div class="img-box mr-3 ">
                                <img src="https://a0.muscache.com/im/pictures/7253e011-7c22-48fd-b75d-d0da35372397.jpg" alt="">
                            </div>
                            <h5>Palermo</h5>
                        </router-link>
                 </div>


                <div  
                class="col-xs-12 col-md-3 my-3 ">
                        <router-link class="d-flex align-items-center router"
                        :to="'advancedsearch'">
                            <div class="img-box mr-3 ">
                                <img src="https://a0.muscache.com/im/pictures/52e8083e-2de2-446d-a860-534eab250541.jpg" alt="">
                            </div>
                            <h5>Puglia</h5>
                        </router-link>
                 </div>


                <div  
                class="col-xs-12 col-md-3 my-3 ">
                        <router-link class="d-flex align-items-center router"
                        :to="'advancedsearch'">
                            <div class="img-box mr-3 ">
                                <img src="https://a0.muscache.com/im/pictures/90dcb9c8-2e6a-4ce3-9acb-86d90d335314.jpg" alt="">
                            </div>
                            <h5>Catania</h5>
                        </router-link>
                 </div>


                <div 
                class="col-xs-12 col-md-3 my-3 ">
                        <router-link class="d-flex align-items-center router"
                        :to="'advancedsearch'">
                            <div class="img-box mr-3 ">
                                <img src="https://a0.muscache.com/im/pictures/ce6c498b-b069-401d-84c8-412bb4a4601e.jpg" alt="">
                            </div>
                            <h5>Milano</h5>
                        </router-link>
                 </div>


                <div  
                class="col-xs-12 col-md-3 my-3 ">
                        <router-link class="d-flex align-items-center router"
                        :to="'advancedsearch'">
                            <div class="img-box mr-3 ">
                                <img src="https://a0.muscache.com/im/pictures/52e8083e-2de2-446d-a860-534eab250541.jpg" alt="">
                            </div>
                            <h5>Bologna</h5>
                        </router-link>
                 </div>



                <div  
                class="col-xs-12 col-md-3 my-3 ">
                        <router-link class="d-flex align-items-center router"
                        :to="'advancedsearch'">
                            <div class="img-box mr-3 ">
                                <img src="https://a0.muscache.com/im/pictures/3849e3f1-d275-43fb-8957-4c90f26e14db.jpg" alt="">
                            </div>
                            <h5>Sardegna</h5>
                        </router-link>
                 </div>


                <div  
                class="col-xs-12 col-md-3 my-3 ">
                        <router-link class="d-flex align-items-center router"
                        :to="'advancedsearch'">
                            <div class="img-box mr-3 ">
                                <img src="https://a0.muscache.com/im/pictures/73ab906b-eea1-425d-9fea-bf2c79d86556.jpg" alt="">
                            </div>
                            <h5>Napoli</h5>
                        </router-link>
                 </div>
           
        </div> -->
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "Home",
    data() {
        return {
            apartmentSponsored: [],
            palermo: `http://127.0.0.1:8000/api/filterapartments?address=Palermo&lat=38.11566&lng=13.36147&range=20&rooms=1&beds=1&services=`,
            puglia:
                "http://127.0.0.1:8000/api/filterapartments?address=Canosa-di-Puglia&lat=41.2225&lng=16.06603&range=20&rooms=1&beds=1&services=",
            catania:
                "http://127.0.0.1:8000/api/filterapartments?address=Catania&lat=37.50248&lng=15.08783&range=20&rooms=1&beds=1&services=",
            milano:
                "http://127.0.0.1:8000/api/filterapartments?address=Milano&lat=45.46362&lng=9.18812&range=20&rooms=1&beds=1&services=",
            bologna:
                "http://127.0.0.1:8000/api/filterapartments?address=Bologna&lat=44.49419&lng=11.34652&range=20&rooms=1&beds=1&services=",
            sardegna:
                "http://127.0.0.1:8000/api/filterapartments?address=Sardegna&lat=40.08578&lng=9.03311&range=20&rooms=1&beds=1&services=",
            napoli:
                "http://127.0.0.1:8000/api/filterapartments?address=Napoli&lat=40.83998&lng=14.25254&range=20&rooms=1&beds=1&services="
        };
    },
    created() {
        this.getApartmentSposored();
    },
    methods: {
        getApartmentSposored() {
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

.img-box {
    height: 70px;
    width: 70px;
    overflow: hidden;
    border-radius: 20px;

    img {
        max-width: 100%;
        object-fit: cover;
    }
}

.box-dintorni a {
    text-decoration: none;
    color: #000;
}
</style>
