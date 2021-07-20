<template>
    <div v-if="apartment">
        <div>Titolo: {{ apartment.title }}</div>
        <div>Camere: {{ apartment.rooms }}</div>
        <div>Letti: {{ apartment.beds }}</div>
        <div>ID: {{ apartment.id }}</div>
        <img :src="apartment.img_path" :alt="apartment.title" />
        <div class="d-flex">
            <div
                v-for="(service, index) in apartment.services"
                :key="index"
                class="d-flex badge badge-primary p-2 m-2"
            >
                {{ service.name }}
            </div>
        </div>
        <!-- <Maps /> -->
    </div>
</template>

<script>
// import Maps from "../components/Maps.vue";

export default {
    name: "Details",
    // component: {
    //     Maps
    // },
    data() {
        return {
            apartment: null
        };
    },
    created() {
        this.getApartmentDetails();
    },
    methods: {
        getApartmentDetails() {
            axios
                .get(
                    `http://127.0.0.1:8000/api/apartments/${this.$route.params.slug}`
                )
                .then(res => {
                    console.log(
                        `http://127.0.0.1:8000/api/apartments/${this.$route.params.slug}`
                    );
                    this.apartment = res.data;
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
};
</script>

<style></style>
