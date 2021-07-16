<template>
  <div class="container pt-1">

      <!-- Header -->
      <Header />

        
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
            <input class="btn btn-success" @click="getApartment" type="button" value="Cerca">
        </div>
      <!-- Main -->
      <main>
          <router-view>
          </router-view>
          <div class="  d-flex flew-wrap">
              <div 
              v-for="(apartment , key) in apartmentsFilter" :key="key"
               class="card m-3">
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
@import'~bootstrap/dist/css/bootstrap.css';
      #map{
        height: 500px;
        max-width: 1110px;
        display: none;
        }


        .range{
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: chartreuse;
            color: #000;
            border-radius: 50%;
            font-size: 15px;
        }


        .card{
            width: 18rem;
            animation: card-effect 0.7s forwards;
           opacity: 0;
           transform: scale(0.1);
        }

        @keyframes card-effect {
            0%{
                opacity: 0;
                transform: scale(0.1);
            }
            100%{
                opacity: 1;
                transform: scale(1.0);
            }
        }



</style>