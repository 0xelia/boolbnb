<template>
  <div v-if="apartment">
    {{ apartment.title }}
  </div>
</template>

<script>
export default {
  props: ['id'],
  data() {
    return {
      apartment: null
    }
  },
  methods: {
    fetchPost() {
      axios.get(`/api/apartments/${this.id}`)
        .then(res => {
          const { apartment } = res.data
          this.apartment = apartment
        })
    }
  },
  created() {
    this.fetchPost()
  }
}
</script>

<style lang="scss" scoped>

</style>