<template>
  <div class="container pt-1">
       
      <!-- Header -->
      <Header />

      <SearchBox />

      <Maps class="my-3" v-show="this.$route.name == 'advancedsearch'" />
    
      <!-- Main -->
      <main>
          <router-view >
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
import Maps from './components/Maps.vue';


export default {
    name:'App',
    components:{
        Header,
        Footer,
        SearchBox,
        Maps,
    },
    data(){
        return {
            apartmentsFilter:[],
        }
    },
    methods:{

    }
   
}

</script>

<style  lang="scss">
@import'~bootstrap/dist/css/bootstrap.css';
    



</style>