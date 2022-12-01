<template>
  <main>
    <!-- Jumbo -->
    <section class="pb-10 md:container">
      <div class="items-center bg-gradient-to-t from-brand-300 py-20 rounded-b-xl">
        <h1 class="text-5xl md:text-6xl font-bold text-gray-700 pb-12 text-center">Trova il tuo appartamento ideale</h1>
        <SearchInput class="mx-auto bg-white"/>
      </div>
    </section>
    <!-- Cards Appartamenti -->
    <section class="container pb-10">
      <div class="md:flex text-center justify-between items-end">
        <h2 class="text-3xl text-gray-700 font-bold">Appartamenti in Evidenza</h2>
        <a href="#" class="underline hidden md:block">Vedi tutto</a>
      </div>
      <div v-if="apartments" class="grid grid-flow-row gap-x-6 gap-y-8 grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 py-6">
        <router-link v-for="(apartment, index) in apartments" :key="index" :to="{ name: 'apartments.show', params: { id: apartment.id }}">
          <ApartmentCard :apartment="apartment"/>
        </router-link>
      </div>
    </section>
  </main>
</template>

<script>
import ApartmentCard from '../components/ApartmentCardComponent.vue';
import SearchInput from '../components/SearchInputComponent.vue';

export default {
  components: {
    ApartmentCard,
    SearchInput,
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
          // apartments.forEach(el => {
          //   el.price = el.price.split('.')[0];
          //   el.address = el.address.split(' ').pop();
          // });
          this.apartments = apartments
        })
    },
  },
  created() {
    this.fetchPosts()
  },
}
</script>

<style lang="scss" scoped>

</style>