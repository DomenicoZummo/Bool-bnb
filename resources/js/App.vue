<template>
  <div class="container">

      <!-- Header -->
      <Header />


      <!-- Main -->
      <main>
       
          <router-view>
          </router-view>

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
            apartments:[],
        }
    },
   
    methods:{
    }
}
</script>

<style lang="scss">
@import'~bootstrap/dist/css/bootstrap.css';


</style>