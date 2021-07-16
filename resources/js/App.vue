<template>
  <div class="container pt-1">
       
      <!-- Header -->
      <Header />

      <SearchBox @getApartmentsSearchBox="getApartment"/>
    
      <!-- Main -->
      <main>
          <router-view :apartments="apartmentsFilter">
          </router-view>
      </main>
      <!-- Footer -->
      <Footer />
      
  </div>
</template>

<script>
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
            apartmentsFilter:[],
        }
    },
    methods:{
        getApartment(array){
            this.apartmentsFilter = array;
        }
    }
   
}
</script>

<style  lang="scss">
@import'~bootstrap/dist/css/bootstrap.css';
    



</style>