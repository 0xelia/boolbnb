<template>
  <div v-if="visible">
    {{ apartment.title }}
  </div>
  <div v-else>
    <h3>Appartamento non disponibile</h3>
  </div>
</template>

<script>
export default {
  props: ['id'],
  computed: {
    visible() {
      return this.apartment && this.apartment.visible
    }
  },
  data() {
    return {
      apartment: null,
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