<template>
  <div>
    <Header/>
    <router-view></router-view>
    <Footer/>
  </div>
</template>

<script>
import Header from '../components/HeaderComponent.vue';
import Footer from '../components/FooterComponent.vue';

export default {
  components: {
    Header,
    Footer,
  }

}
</script>

<style>
  Footer{
    position: fixed;
    bottom: 0;
    width: 100%;
  }
</style>