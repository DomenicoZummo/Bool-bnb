<template>
    <div>
        <div id="searchbox-front" class="mb-3"></div>
        <div class="d-flex box-input align-items-center">
            <!-- <select @change="setRange(range)" v-model="range" class="mr-5" name="km" id="km">
                <option value="1">1KM</option>
                <option value="3">2KM</option>
                <option value="5">5KM</option>
                <option value="10">10KM</option>
                <option value="20">20KM</option>
                <option value="50">50KM</option>
                <option value="100">100KM</option>
            </select> -->

            <input
                @change="setRange(range)"
                v-model="range"
                class="mr-3"
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

            <!-- Bottone ricerca normale -->

            <div @click="getApartmentFiltered">
                <router-link
                    @click="getApartmentFiltered"
                    :apartmentFiltered="apartmentsFilter"
                    class="btn btn-success "
                    :to="{ name: 'advancedsearch' }"
                    >Cerca</router-link
                >
            </div>

            <!-- Bottone filtri -->
            <input
                v-show="this.$route.name == 'advancedsearch'"
                @click="clickFilter"
                class="ml-5"
                type="button"
                value="Filtri"
            />
            <div
                v-show="servicesChecked.length > 0"
                class="badge badge-primary p-2 m-2"
            >
                Filtri attivi : {{ servicesChecked.length }}
            </div>

            <div>
                <h6 v-show="this.$route.name == 'advancedsearch'" class="ml-3">
                    Risultati: {{ apartmentsFilter.length }}
                </h6>
            </div>
        </div>

        <div v-show="clickFilterStatus" class="searchFilter">
            <div class="box-search py-2">
                <div
                    v-for="(service, index) in services"
                    :key="index"
                    class="checkbox-service ml-3"
                >
                    <label :for="service.name">{{ service.name }}</label>
                    <input
                        type="checkbox"
                        :name="service.name"
                        :id="service.name"
                        :value="service.id"
                        v-model="servicesChecked"
                    />
                </div>
                <span class="close" @click="clickFilter">Close</span>
            </div>
        </div>

        <div class="inp" v-show="this.$route.name == 'advancedsearch'">
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
</template>

<script>
import axios from "axios";
export default {
    name: "SearchBox",
    data() {
        return {
            lat: window.lat,
            lng: window.lng,
            address: window.address,
            apartmentsFilter: [],
            servicesChecked: [],
            services: [],
            range: "20",
            clickFilterStatus: false,
            minRooms: "1",
            minBeds: "1"
        };
    },
    created() {
        this.getServices();
    },

    methods: {
        getServices() {
            this.servicesChecked = [];
            this.services = [];
            axios
                .get(`http://127.0.0.1:8000/api/services`)
                .then(result => {
                    this.services = result.data;
                    console.log(result.data);
                })
                .catch(error => {
                    console.log(error);
                });
        },

        clickFilter() {
            this.clickFilterStatus = !this.clickFilterStatus;
        },

        getApartmentFiltered() {
            this.apartmentsFilter = [];
            axios
                .get(
                    `http://127.0.0.1:8000/api/filterapartments?address=${window.address}&lat=${window.lat}&lng=${window.lng}&range=${this.range}&rooms=${this.minRooms}&beds=${this.minBeds}&services=${this.servicesChecked}`
                )
                .then(result => {
                    console.log("Stanze minime", this.minRooms);
                    console.log("Letti minimi", this.minBeds);
                    console.log("Servizi", this.servicesChecked);
                    console.log(
                        `http://127.0.0.1:8000/api/filterapartments?address=${window.address}&lat=${window.lat}&lng=${window.lng}&range=${this.range}&rooms=${this.minRooms}&beds=${this.minBeds}&services=${this.servicesChecked}`
                    );

                    console.log(result.data);
                    result.data.filter(element => {
                        if (element.visibility) {
                            this.apartmentsFilter.push(element);
                        }
                    });
                })
                .catch(error => {
                    console.log(error);
                });

            this.$emit("getApartmentFiltered", this.apartmentsFilter);
        },

        // getApartment() {
        //     axios
        //         .get(
        //             `http://127.0.0.1:8000/api/apartments?address=${window.address}&lat=${window.lat}&lng=${window.lng}&range=${this.range}`
        //         )
        //         .then(result => {
        //             this.apartmentsFilter = [];
        //             console.log(result.data);
        //             result.data.filter(element => {
        //                 if (element.visibility) {
        //                     this.apartmentsFilter.push(element);
        //                 }
        //             });
        //         })
        //         .catch(error => {
        //             console.log(error);
        //         });
        //     // this.$emit("getApartmentFiltered", this.apartmentsFilter);
        // },
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
        }
    }
}
</style>
