<template>
  <div>Advanced Search</div>
</template>

<script>
export default {
  methods: {
    fetchApartments() {
      axios.get('/api/apartments/index/advanced_search')
        .then(res => {
          const { results } = res.data
          results.forEach(result => {
            console.log(result);            
          });
        })
    }
  },
  created() {
    this.fetchApartments()
  }
}
</script>

<style lang="scss" scoped>

</style>