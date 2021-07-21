<template>
    <div>
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
                                    params: {
                                        slug: apartment.slug
                                    }
                                }"
                                class="btn btn-primary"
                            >
                                Go somewhere
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
        return {};
    },
    methods: {}
};
</script>

<style scoped lang="scss">


.card {
    animation: card-effect 0.7s forwards;
    opacity: 0;
    transform: scale(0.1);
    overflow: auto;
    min-height: 500px;
    max-height: 500px;
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
