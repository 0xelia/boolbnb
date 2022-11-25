<template>
  <div class="container">
    <!-- Jumbo -->
    <div></div>
    <!-- Cards Appartamenti -->
    <div v-if="apartments" class="grid h-full relative grid-cols-1 md:grid-cols-3 2xl:grid-cols-4">
      <router-link class="h-full relative" v-for="(apartment, index) in apartments" :key="index" :to="{ name: 'apartments.show', params: { id: apartment.id }}">
        <ApartmentCard :apartment="apartment"/>
      </router-link>
    </div>
  </div>
</template>

<script>
import ApartmentCard from '../components/ApartmentCardComponent.vue';

export default {
  components: {
    ApartmentCard,
  },
  data() {
    return {
      apartments: [],
    }
  },
  methods: {
    fetchPosts() {
      axios.get('/api/apartments/index/sponsored')
        .then(res => {
          const { apartments } = res.data
          apartments.forEach(el => {
            this.apartments.push(el)
          });
          console.log(this.apartments);
        })
    }
  },
  created() {
    this.fetchPosts()
  }
}
</script>

<style lang="scss" scoped>

</style>