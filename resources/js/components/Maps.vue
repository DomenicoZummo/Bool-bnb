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
    margin-top: 100px;
    border-radius: 15% 15% 0 15%;
    border: 1px solid rgb(61, 123, 238);
    transition: 0.3s;
    &:hover {
        border: 2px solid blue;
    }
}
</style>
