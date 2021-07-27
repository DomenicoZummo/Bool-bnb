<template>
    <div>
        <div id="map"></div>
    </div>
</template>

<script>
export default {
    name: "Maps"
};
</script>

<style scoped lang="scss">
#map {
    width: 500px;
    height: 500px;
    margin-right: 50px;
    margin-top: 130px;
    border-radius: 15% 15% 0 15%;
    border: 2px solid #ff385dad;
    transition: 0.3s;
    &:hover {
        border: 2px solid #ff385c;
    }
}
</style>
