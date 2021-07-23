<template>
    <div class="py-5 container">
        <div
            v-if="apartments.length > 0"
            class="d-flex container flex-wrap box-apartments"
        >
            <div
                v-for="(apartment, key) in apartments"
                :key="key"
                class=" my-3 px-3 col-xs-12 col-md-4"
            >
                <div class="card ">
                    <div class="box-img">
                        <img
                            class="card-img-top"
                            :src="apartment.img_path"
                            alt="Card image cap"
                        />
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">{{ apartment.title }}</h5>
                        <p class="card-text">
                            <i class="fas fa-map-marker-alt mr-1"></i
                            >{{ apartment.address }}
                        </p>
                        <div class="descriptions d-flex flex-wrap mb-3">
                            <p class="card-text ml-3">
                                Floor: {{ apartment.floor }}
                            </p>
                            <p class="card-text ml-3">
                                Rooms: {{ apartment.rooms }}
                            </p>
                            <p class="card-text ml-3">
                                <i class="fas fa-bed mr-1"></i>
                                {{ apartment.beds }}
                            </p>
                            <p class="card-text ml-3">
                                <i class="fas fa-toilet"></i>
                                {{ apartment.bathrooms }}
                            </p>
                        </div>
                        <div class="service">
                            <h6>Services:</h6>

                            <p
                                v-for="(service, key) in apartment.services"
                                :key="key"
                                class="card-text badge badge-warning p-2 m-2"
                            >
                                {{ service.name }}
                            </p>
                        </div>
                    </div>
                    <div class="btn-service ml-5">
                        <div class="mb-3">
                            <router-link
                                @click="getApartmentFiltered"
                                :apartment="apartment"
                                :to="{
                                    name: 'apartment-details',
                                    params: {
                                        slug: apartment.slug,
                                        latitude: apartment.latitude,
                                        longitude: apartment.longitude
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
        </div>
        <h1 v-else>No results</h1>
    </div>
</template>

<script>
export default {
    name: "AdvancedSearch",
    props: {
        apartments: Array
    },
    data() {
        return {
            apartmentsFilter: []
        };
    },

    methods: {
        getApartmentFiltered() {
            this.apartmentsFilter = [];
            axios
                .get(
                    `http://127.0.0.1:8000/api/filterapartments?address=${window.address}&lat=${window.lat}&lng=${window.lng}&range=${this.range}&rooms=${this.minRooms}&beds=${this.minBeds}&services=${this.servicesChecked}`
                )
                .then(result => {
                    result.data.filter(element => {
                        if (element.visibility) {
                            let distance = Math.sqrt(
                                (element.latitude - window.lat) *
                                    (element.latitude - window.lat) +
                                    (element.longitude - window.lng) *
                                        (element.longitude - window.lng)
                            );
                            element["distance"] = distance;
                            this.apartmentsFilter.push(element);
                        }
                    });
                    this.apartmentsFilter.sort((a, b) =>
                        a.distance > b.distance ? 1 : -1
                    );
                })
                .catch(error => {
                    console.log(error);
                });

            this.$emit("getApartmentFiltered", this.apartmentsFilter);
        }
    }
};
</script>

<style scoped lang="scss">
.card-title {
    text-transform: capitalize;
}

.box-apartments {
    scrollbar-width: thin;
    scrollbar-color: dodgerblue lightblue;
}
.card {
    animation: card-effect 0.7s forwards;
    opacity: 0;
    transform: scale(0.1);
    overflow: auto;
    min-height: 650px;
    max-height: 650px;
    min-width: 250px;

    .box-img {
        height: 200px;
        width: 100%;
        overflow: hidden;
        img {
            width: 100%;
            object-fit: cover;
        }
    }
}

@keyframes card-effect {
    0% {
        opacity: 0;
        transform: scale(0.1);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}
</style>
