<template>
  <div class="container">

      <!-- Header -->
      <Header />


      <!-- Main -->
      <main>
       
          <router-view>
          </router-view>

      </main>


      <ul>
              <li class="my-5" v-for="apartment in apartments" :key="apartment.id">
                  <h1>Title : {{ apartment.title }}</h1>
                  <h4>Address : {{ apartment.address }}</h4>
                  <h2>Creato da {{ apartment.user.name }}  {{ apartment.user.surname }}</h2>
                 <ul>
                     <h2>Servizi</h2>
                     <li v-for="(service , key) in apartment.services" :key="key">
                         <h5>{{service.name}}</h5>
                     </li>
                 </ul>
              </li>
          </ul>


      <input @click="getPoint" type="button" value="Cerca">
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
            apartments:[],
        }
    },
   
    methods:{
         getPoint(){
        //  axios.get(`https://api.tomtom.com/search/2/search/${window.address}.json?/?lat=${window.lat}&lon=${window.lng}&ountrySet=IT&radius=100000&key=gKIZzIyagJPsNGDOLL9WGenkQlFeapDb`)
        axios.get('http://127.0.0.1:8000/api/apartments')
             .then( result => {
                 this.apartments = result.data;
             })
             .catch( error => {
                 console.log(error);
             })


        }
    }
}
</script>

<style lang="scss">
@import'~bootstrap/dist/css/bootstrap.css';


</style>