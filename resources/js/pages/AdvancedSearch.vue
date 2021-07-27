<template>
    <div class="py-5 container">
        <div v-if="apartments.length > 0" class="d-flex container flex-wrap">
            <div
                v-for="(apartment, key) in apartments"
                :key="key"
                class=" my-3 px-3 col-xs-12 col-md-4 my-col"
            >
                <div
                    :class="{ sponsor: apartment.sponsorships.length > 0 }"
                    class="card"
                >
                    <div class="box-img">
                        <img
                            class="card-img-top"
                            :src="apartment.img_path"
                            alt="Card image cap"
                        />
                    </div>

                    <div class="card-body">
                        <h4 class="card-title">{{ apartment.title }}</h4>
                        <p class="card-text address">
                            <i class="fas fa-map-marker-alt mr-2"></i
                            >{{ apartment.address }}
                        </p>
                        <div class="descriptions d-flex flex-wrap">
                            <p class="card-text">
                                <span>Floor:</span> {{ apartment.floor }}
                            </p>
                            <p class="card-text ml-3">
                                <span>Rooms:</span> {{ apartment.rooms }}
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
                            <p
                                v-for="(service, key) in apartment.services"
                                :key="key"
                                class="card-text badge badge-boolbnb p-2 m-2"
                            >
                                {{ service.name }}
                            </p>
                        </div>
                    </div>
                    <div class="btn-details-center">
                        <div>
                            <router-link
                                :to="{
                                    name: 'apartment-details',
                                    params: {
                                        slug: apartment.slug,
                                        latitude: apartment.latitude,
                                        longitude: apartment.longitude
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
        </div>
        <h1 v-else>{{ isLoading ? isLoading : this.noApartments }}</h1>
    </div>
</template>

<script>
export default {
    name: "AdvancedSearch",
    props: {
        apartments: Array,
        isLoading: String
    },
    data() {
        return {
            noApartments: ""
        };
    }
};
</script>

<style scoped lang="scss">
.card-title {
    text-transform: capitalize;
}

.card-text span {
    color: #212529;
    font-weight: 700;
}

p.card-text {
    margin-bottom: 10px;
}

.badge-boolbnb {
    color: #ff385c;
    background: #fff;
    border: 1px solid #ff385c;
}

.my-col {
    transition: transform 0.3s 0.2s;
    &:hover {
        transform: perspective(1px) translate3d(0px, -15px, 0px);
        z-index: 1;
    }
}

.card {
    position: relative;
    animation: card-effect 0.3s forwards;
    opacity: 0;
    transform: scale(0.1);
    overflow: auto;
    min-height: 500px;
    max-height: 500px;
    min-width: 250px;
    border-radius: 20px;

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

.sponsor::after {
    // box-shadow: 0px 0px 5px 4px #ff385c;
    content: "Sponsored";
    position: absolute;
    top: 8px;
    right: 8px;
    font-weight: 400;
    padding: 0 3px;
    color: #fff;
    font-size: 13px;
    text-transform: uppercase;
    border-bottom: 1px solid #fff;
    border-radius: 5px;
    background-color: rgba(0, 0, 0, 0.25);
    letter-spacing: 1px;
}

.service {
    height: 92px;
    width: 100%;
    overflow-y: auto;
    p {
        cursor: pointer;
    }
}

.btn-details-center {
    margin: 0 auto;
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
        margin-bottom: 20px;
    }
}
</style>
