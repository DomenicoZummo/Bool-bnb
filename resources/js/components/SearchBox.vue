<template>
    <div class="searchbox-container">
        <div class="d-flex align-items-center justify-content-center">
            <!-- Search-bar -->
            <div id="searchbox-front" class="mb-3 "></div>
            <!-- Search button -->
            <div @click="getApartmentFiltered">
                <router-link
                    @click="getApartmentFiltered"
                    :apartmentFiltered="apartmentsFilter"
                    class="btn-custom"
                    :to="{ name: 'advancedsearch' }"
                    ><i class="fas fa-search"></i
                ></router-link>
            </div>
            <!-- Filters button -->
            <input
                v-show="this.$route.name == 'advancedsearch'"
                @click="clickFilter"
                class="ml-2 mr-5 btn btn-warning"
                type="button"
                value="Filtri"
            />
        </div>

        <div
            v-if="this.$route.name == 'advancedsearch'"
            class="d-flex box-input align-items-center justify-content-center"
        >
            <!-- Radius -->

            <input
                @change="setRange(range)"
                v-model="range"
                min="5"
                max="100"
                value="range"
                step="5"
                type="range"
                name="range"
                id="range"
            />
            <label value="20" class="mx-5 range" for="range"
                >{{ range }} km</label
            >

            <!-- Active services badge -->
            <div
                v-show="
                    servicesChecked.length > 0 &&
                        this.$route.name == 'advancedsearch'
                "
                class="badge badge-primary p-2 m-2"
            >
                Filtri attivi : {{ servicesChecked.length }}
            </div>

            <!-- Number of results finded -->
            <div
                v-show="apartmentsFilter.length > 0"
                class="m-2 p-2 badge badge-success"
            >
                Risultati: {{ apartmentsFilter.length }}
            </div>
            <!-- Filters menu -->
            <div v-show="clickFilterStatus" class="searchFilter">
                <div class="box-search py-2 d-flex">
                    <div class="box-check mr-3">
                        <div
                            v-for="(service, index) in services"
                            :key="index"
                            class="checkbox-service ml-3"
                        >
                            <label :for="service.name">{{
                                service.name
                            }}</label>
                            <input
                                type="checkbox"
                                :name="service.name"
                                :id="service.name"
                                :value="service.id"
                                v-model="servicesChecked"
                            />
                        </div>
                    </div>
                    <span class="close" @click="clickFilter">Close</span>
                    <div class="room-bed">
                        <!-- Numbers of beds -->
                        <div class="mt-3 mr-3">
                            <label class="form-label" for="beds">Beds</label>
                            <input
                                id="beds"
                                name="beds"
                                min="1"
                                max="20"
                                required
                                type="number"
                                v-model.number="minBeds"
                                value="minBeds"
                            />
                        </div>

                        <!-- Numbers of rooms -->
                        <div class="mt-3 mr-3">
                            <label class="form-label" for="rooms">Rooms </label>
                            <input
                                id="rooms"
                                name="rooms"
                                required
                                min="1"
                                max="20"
                                type="number"
                                v-model.number="minRooms"
                                value="minRooms"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "SearchBox",
    data() {
        return {
            apartmentsFilter: [],
            servicesChecked: [],
            apartamentFilterSponsor: [],
            services: [],
            range: "20",
            clickFilterStatus: false,
            minRooms: "1",
            minBeds: "1",
            isLoading: "Loading..."
        };
    },
    created() {
        this.getServices();
    },

    methods: {
        // Axios call to get services list from dp on creating
        getServices() {
            this.servicesChecked = [];
            this.services = [];
            axios
                .get(`http://127.0.0.1:8000/api/services`)
                .then(result => {
                    this.services = result.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        // Open/Close the filters menu
        clickFilter() {
            this.clickFilterStatus = !this.clickFilterStatus;
        },

        // Axios call to get the apartments with filters if they exist
        getApartmentFiltered() {
            this.apartmentsFilter = [];
            this.apartamentFilterSponsor = [];
            this.$emit("isLoading", this.isLoading);
            axios
                .get(
                    `http://127.0.0.1:8000/api/filterapartments?address=${window.address}&lat=${window.lat}&lng=${window.lng}&range=${this.range}&rooms=${this.minRooms}&beds=${this.minBeds}&services=${this.servicesChecked}`
                )
                .then(result => {
                    result.data.filter(element => {
                        if (element.visibility) {
                            let sponsor = element.sponsorships;

                            if (sponsor.length > 0) {
                                this.apartamentFilterSponsor.push(element);
                            } else {
                                let distance = Math.sqrt(
                                    (element.latitude - window.lat) *
                                        (element.latitude - window.lat) +
                                        (element.longitude - window.lng) *
                                            (element.longitude - window.lng)
                                );
                                element["distance"] = distance;
                                this.apartmentsFilter.push(element);
                            }
                        }
                    });
                    this.apartmentsFilter.sort((a, b) =>
                        a.distance > b.distance ? 1 : -1
                    );

                    this.apartamentFilterSponsor.forEach(element => {
                        this.apartmentsFilter.unshift(element);
                    });
                })
                .catch(error => {
                    console.log(error);
                })
                .finally(() => {
                    this.$emit("getApartmentFiltered", this.apartmentsFilter);
                });
        },

        // Set the radius of the research dynamically
        setRange(value) {
            this.range = value;
        }
    }
};
</script>

<style scoped lang="scss">
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
        width: 600px;
        height: 500px;
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
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 20px;
            cursor: pointer;
            color: red;
        }
    }
}

.range {
    width: 60px;
    height: 20px;
    color: #000;
    font-weight: 500;
    font-size: 16px;
}

.searchbox-container {
    height: 300px;
    background: rgb(138, 69, 69);
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
