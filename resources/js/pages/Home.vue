<template>
  <main>
    <!-- Jumbo -->
    <section class="pb-10 container">
      <div class="items-center bg-brand-300 py-20 px-6 rounded-xl">
        <h1 class="text-5xl md:text-6xl font-bold text-gray-700 pb-12 text-center">Trova il tuo appartamento ideale</h1>
        <SearchInput class="mx-auto bg-white"/>
      </div>
    </section>
    <!-- Cards Appartamenti -->
    <section class="container pb-10" v-if="apartments.length < 0">
      <div class="md:flex text-center justify-between items-end">
        <h2 class="text-3xl text-gray-700 font-bold">Appartamenti in Evidenza</h2>
        <!-- <a href="#" class="underline hidden md:block">Vedi tutto</a> -->
      </div>
      <div v-if="apartments" class="grid grid-flow-row gap-x-6 gap-y-8 grid-cols-1 md:grid-cols-2 2xl:grid-cols-4 py-6">
        <router-link v-for="(apartment, index) in apartments" :key="index" :to="{ name: 'apartments.show', params: { id: apartment.id }}">
          <ApartmentCard :apartment="apartment"/>
        </router-link>
      </div>
    </section>

    <section v-for="(city, index) in cities" :key="index" :class="index === cities.length - 1 ? 'mb-0' : 'mb-10'" class="container">
      <h2 class="text-center md:text-left mb-2 text-3xl text-gray-700 font-bold">Appartmaneti a {{ city }}</h2>
      <div v-if="apartments_by_city" class="grid gap-x-6 gap-y-8 grid-cols-1 md:grid-cols-2 2xl:grid-cols-4">
        <router-link v-for="apartment in apartments_by_city[city]" :key="apartment.id" :to="{ name: 'apartments.show', params: { id: apartment.id }}">
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
      all_apartments: [],
      apartments: null,
      cities: []
    }
  },
  computed: {
    apartments_by_city() {
      const data = {}

      this.cities.forEach(city => {
        data[city] = []
      })

      this.all_apartments.forEach(apartment => {
        const { city } = apartment

        if (data[city] && data[city].length < 4) {
          data[city].push(apartment)
        }
      })

      return data
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
    fetchPostByCity() {
      axios.get('/api/apartments/index/cities').then(res => {
        const { apartments } = res.data
        const cities = []
        apartments.forEach(apartment => {
          cities.push(apartment.city)
        });
        this.cities = cities
      })
    },
    fetchAllApartments() {
      axios.get('/api/apartments/index/all')
        .then(res => {
          const { apartments } = res.data
          this.all_apartments = apartments
        })
    },
  },
  created() {
    this.fetchPosts()
    this.fetchPostByCity()
    this.fetchAllApartments()
  }
}
</script>

<style lang="scss" scoped>

</style>