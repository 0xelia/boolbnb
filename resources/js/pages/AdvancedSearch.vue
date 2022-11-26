<template>
  <div>Advanced Search</div>
</template>

<script>
export default {
  methods: {
    fetchApartments() {
      axios.get('/api/apartments/index/advanced_search')
        .then(res => {

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