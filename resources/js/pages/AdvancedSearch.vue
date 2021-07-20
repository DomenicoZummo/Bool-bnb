<template>
    <div>
        <div class="d-flex box-search">
            <div
                v-if="apartments.length > 0"
                class="d-flex flex-column box-apartments flew-wrap"
            >
                <div
                    v-for="(apartment, key) in apartments"
                    :key="key"
                    class="card m-3"
                >
                    <img
                        class="card-img-top"
                        :src="apartment.img_path"
                        alt="Card image cap"
                    />
                    <div class="card-body">
                        <h5 class="card-title">{{ apartment.title }}</h5>
                        <p class="card-text">{{ apartment.address }}</p>
                        <p class="card-text">Floor: {{ apartment.floor }}</p>
                        <p class="card-text">Rooms: {{ apartment.rooms }}</p>
                        <p class="card-text">Beds: {{ apartment.beds }}</p>
                        <p class="card-text">{{ apartment.description }}</p>
                        <h6>Services:</h6>
                        <p
                            v-for="(service, key) in apartment.services"
                            :key="key"
                            class="card-text badge badge-warning p-2 m-2"
                        >
                            {{ service.name }}
                        </p>
                        <div>
                            <router-link
                                :apartment="apartment"
                                :to="{
                                    name: 'apartment-details',
                                    params: { slug: apartment.slug }
                                }"
                                class="btn btn-primary"
                            >
                                Go somewhere
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
            <h1 v-else>No results</h1>
        </div>
    </div>
</template>

<script>
export default {
    name: "AdvancedSearch",
    props: {
        apartments: Array
    },
    data() {
        return {};
    },
    methods: {}
};
</script>

<style scoped lang="scss">
.range {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: chartreuse;
    color: #000;
    border-radius: 50%;
    font-weight: bold;
    font-size: 10px;
}

.card {
    width: 18rem;
    animation: card-effect 0.7s forwards;
    opacity: 0;
    transform: scale(0.1);
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

.box-apartments {
    max-height: 70vh;
    width: 20vw;
    overflow-y: auto;
}
</style>
