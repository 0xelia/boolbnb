<template>
  <div class="container">
    <!-- Jumbo -->
    <section>
      <div></div>
    </section>
    <!-- Cards Appartamenti -->
    <section>
      <div v-if="apartments">
        <router-link v-for="(apartment, index) in apartments" :key="index" :to="{ name: 'apartments.show', params: { id: apartment.id }}">
          <ApartmentCard :apartment="apartment"/>
        </router-link>
      </div>
    </section>
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
      apartments: null,
    }
  },
  methods: {
    fetchPosts() {
      axios.get('/api/apartments/index/sponsored')
        .then(res => {
          const { apartments } = res.data
          this.apartments = apartments;
          console.log(this.apartments)
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