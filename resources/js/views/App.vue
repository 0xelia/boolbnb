<template>
  <div class="flex min-h-screen flex-col">
    <Header />
    <router-view class="flex-grow"></router-view>
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
  },
  props: ['user']
}
</script>

<style>
</style>