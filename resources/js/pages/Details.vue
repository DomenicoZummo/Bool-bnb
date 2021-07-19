<template>
    <section>
        <div v-for="apartment in apartments" :key="apartment.id">

            <div v-if="apartment.id === apartmentID">
                <div>Titolo: {{ apartment.title }}</div>
                <div>Camere: {{ apartment.rooms }}</div>
                <div>Letti: {{ apartment.beds }}</div>
                <div>ID: {{ apartment.id }}</div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    props: {
        apartments: Array,
    },
    data(){
        return {
            apartmentID: this.$route.params.id,
        }
    },
}
</script>

<style>

</style>