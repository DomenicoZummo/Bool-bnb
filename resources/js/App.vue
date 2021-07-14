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
    }
}
</script>

<style lang="scss">
@import'~bootstrap/dist/css/bootstrap.css';


</style>