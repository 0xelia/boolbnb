<template>
  <div v-if="apartments">
    home
  </div>
</template>

<script>
export default {
  data() {
    return {
      apartments: null
    }
  },
  methods: {
    fetchPosts() {
      axios.get('/api/apartments')
        .then(res => {
          const { apartments } = res.data
          this.apartments = apartments
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