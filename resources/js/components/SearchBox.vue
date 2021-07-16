<template>
  <div>
      <div @click="getApartment"  id="searchbox-front"  class="mb-3"></div>
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

            <input @change="setRange(range)" v-model="range" class="mr-3" min="0" max="100" value="range" step="5" default="20" type="range" name="range" id="range">
            <label value="20" class="mx-5 range" for="range">{{range}} km</label>
             <div  @click="$emit('getApartmentsSearchBox', apartmentsFilter)">
                 <router-link class="btn btn-success " :to="{ name: 'advancedsearch' }"
            >Cerca</router-link>
             </div>
            </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
    name:'SearchBox',
    data(){
        return {
            lat:window.lat,
            lng:window.lng,
            address:window.address,
            apartmentsFilter:[],
            range:'20',
        }
    },

    methods:{

        getApartment(){
            axios.get(`http://127.0.0.1:8000/api/apartments?address=${window.address}&lat=${window.lat}&lng=${window.lng}&range=${this.range}`)
            .then(result => {
                this.apartmentsFilter = [];
                console.log(result.data);
                result.data.filter(element => {
                if(element.visibility){
                    this.apartmentsFilter.push(element);
                }
            });
            })
            .catch( error => {
                console.log(error);
            });
            
        },
        setRange(value){
            this.range = value;
        }
    }
}
</script>

<style scoped lang="scss">
 
</style>