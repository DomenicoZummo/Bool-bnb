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
                class=" ml-1  mr-3 btn-custom-white"
                type="button"
                value="Filtri"
            />
        </div>

        <div
            v-if="this.$route.name == 'advancedsearch'"
            class="d-flex box-input align-items-center justify-content-center"
        >
            <!-- Active services badge -->
            <div
                v-show="
                    servicesChecked.length > 0 &&
                        this.$route.name == 'advancedsearch'
                "
                class="btn-custom-white p-2 m-2"
            >
                Filtri attivi : {{ servicesChecked.length }}
            </div>

            <!-- Number of results finded -->
            <div
                v-show="apartmentsFilter.length > 0"
                class="m-2 p-2 btn-custom-white"
            >
                Risultati: {{ apartmentsFilter.length }}
            </div>
            <!-- Filters menu -->
            <div v-show="clickFilterStatus" class="searchFilter">
                <div class="box-search">
                    <div class="sub d-flex justify-content-center mb-2">
                        <h6 class="text-center subtitle">Services</h6>
                    </div>
                    <div class="box-check mr-3 d-flex flex-wrap">
                        <div
                            v-for="(service, index) in services"
                            :key="index"
                            class="checkbox-service"
                        >
                            <input
                                type="checkbox"
                                :name="service.name"
                                :id="service.name"
                                :value="service.id"
                                v-model="servicesChecked"
                                class="new-checkbox"
                            />
                            <label :for="service.name" class="label-text">{{
                                service.name
                            }}</label>
                        </div>
                    </div>
                    <div class="sub d-flex justify-content-center mb-1 mt-2">
                        <h6 class="text-center subtitle">
                            Apartment features
                        </h6>
                    </div>
                    <div class="room-bed d-flex justify-content-center">
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
                    <div class="sub d-flex justify-content-center mb-1 mt-3">
                        <h6 class="text-center subtitle mb-4">
                            Distance
                        </h6>
                    </div>
                    <!-- Radius -->
                    <div
                        class="range-box mt-2 d-flex justify-content-center align-items-center"
                    >
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
                        <label value="20" class="mx-4 range" for="range"
                            >{{ range }} km</label
                        >
                    </div>
                    <span class="close" @click="clickFilter"
                        ><i class="fas fa-times"></i
                    ></span>
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
        max-width: 600px;
        height: 550px;
        background: #fff;
        color: #000;
        overflow-y: auto;
        transform: scale(0.1);
        opacity: 0;
        padding: 15px 15px;
        border-radius: 5px;
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
            font-size: 30px;
            cursor: pointer;
            color: #ff385c;
        }
    }
}

.range {
    color: #ff385c;
    font-weight: 400;
    font-size: 16px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

input[type="range"] {
    -webkit-appearance: none;
    background-color: #ccc;
    height: 10px;
    width: 200px;
    border-radius: 25px;
}

input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    background-color: #ff385c;
    height: 30px;
    width: 15px;
    border-radius: 3px;
    opacity: 0.8;
    cursor: pointer;
    transition: 0.3s;
    &:hover {
        opacity: 1;
    }
}

input[type="number"]::-webkit-inner-spin-button {
    opacity: 1;
}

.checkbox-service {
    flex-basis: calc(100% / 4 - 20px);
    margin: 10px 10px;
}

.new-checkbox {
    position: absolute;
    opacity: 0;
}

.new-checkbox + label {
    position: relative;
    cursor: pointer;
    padding: 0;
}

.new-checkbox + label:before {
    content: "";
    margin-right: 10px;
    display: inline-block;
    vertical-align: text-top;
    width: 20px;
    height: 20px;
    background: #ddd;
    border-radius: 3px;
}

.new-checkbox:hover + label:before {
    background: #ccc;
}

.new-checkbox:checked + label:before {
    background: #ff385c;
}

.new-checkbox:checked + label:after {
    content: "\f00c";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 13px;
    color: #fff;
    position: absolute;
    left: 4px;
    top: 2px;
}

.label-text {
    font-size: 14px;
}

.searchbox-container {
    height: 650px;
    background: url("https://a0.muscache.com/im/pictures/258b129d-d1cd-48b5-86d4-86206c13ebf7.jpg?im_w=1440");
    display: flex;
    justify-content: center;
    align-items: center;
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}

.subtitle {
    border-bottom: 1px solid #ff385c;
    border-radius: 5px;
    display: inline-block;
    padding-bottom: 2px;
    width: 150px;
}
</style>
