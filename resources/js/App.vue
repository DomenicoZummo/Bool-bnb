<template>
  <div class="container pt-1">

      <!-- Header -->
      <Header />

        <input class="btn btn-success" @click="getApartment" type="button" value="Cerca">
      <!-- Main -->
      <main>
          <router-view>
          </router-view>
          <div class="  d-flex flew-wrap">
              <div 
              v-for="(apartment , key) in apartmentsFilter" :key="key"
               class="card m-3" style="width: 18rem;">
               <img class="card-img-top" :src="apartment.img_path" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{apartment.title}}</h5>
                    <p class="card-text">{{apartment.address}}</p>
                    <p class="card-text">{{apartment.floor}}</p>
                    <p class="card-text">{{apartment.rooms}}</p>
                    <p class="card-text">{{apartment.beds}}</p>
                    <p class="card-text">{{apartment.description}}</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
                </div>
          </div>
      </main>
      <!-- Footer -->
      <Footer />
      
  </div>


</template>

<script>
import axios from 'axios';
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';


export default {
    name:'App',
    components:{
        Header,
        Footer,
    },
    data(){
        return {
            lat:window.lat,
            lng:window.lng,
            address:window.address,
            apartmentsFilter:[],
        }
    },
   
    methods:{

        getApartment(){
            axios.get(`http://127.0.0.1:8000/api/apartments?address=${window.address}&lat=${window.lat}&lng=${window.lng}`)
            .then(result => {
                this.apartmentsFilter = [];
                result.data.filter(element => {
                if(element.visibility){
                    this.apartmentsFilter.push(element);
                }
            });
            })
            .catch( error => {
                console.log(error);
            });


            
        }
    }
}
</script>

<style lang="scss">
@import'~bootstrap/dist/css/bootstrap.css';
      #map{
        height: 500px;
        max-width: 1110px;
        display: none;
        }


</style>