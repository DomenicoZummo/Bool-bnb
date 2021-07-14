<template>
  <div class="container">

      <!-- Header -->
      <Header />


      <!-- Main -->
      <main>
          <SearchBox />
          <router-view>
          </router-view>
      </main>


      <input @click="getPoint" type="button" value="Cerca">
      <!-- Footer -->
      <Footer />
      
  </div>


</template>

<script>
import axios from 'axios';
import Header from './components/Header.vue';
import Footer from './components/Footer.vue';
import SearchBox from './components/SearchBox.vue';

export default {
    name:'App',
    components:{
        Header,
        Footer,
        SearchBox,
    },
    data(){
        return {
           lat:'',
           lng:'',
           address:'',
        }
    },
   
    methods:{
         getPoint(){

         axios.get(`https://api.tomtom.com/search/2/search/${window.address}.json?/?lat=${window.lat}&lon=${window.lng}&ountrySet=IT&radius=10000&key=gKIZzIyagJPsNGDOLL9WGenkQlFeapDb`)
             .then( result => {
                 console.log(result);
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