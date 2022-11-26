<template>
  <div class="container">
      <div class="text-brand-500 py-7"><i class="fa-solid fa-chevron-left"></i> Torna alla pagina di ricerca</div>
      <div v-if="apartment" class="font-semibold text-5xl">
        <h2>
          {{ apartment.title }}
        </h2>
      </div>
      <div class="py-4 pb-8">
        {{ apartment.address }}
      </div>
      <div class="grid grid-cols-2 gap-6">
        <div class="w-9/12 row-span-2 ">
          <img class=" w-full object-cover object-center rounded-xl" :src="apartment.image" alt="">
        </div>
        <div class="w-3/12">
          <img class="object-cover object-center rounded-xl" src="https://picsum.photos/200/300" alt="">
          <img class="object-cover object-center rounded-xl" src="https://picsum.photos/200/300" alt="">
        </div>
      </div>
      <div class="grid grid-cols-2 gap-6">
        <div class="border flex content-center rounded-lg p-6">
          <div class="pr-32">
            <h4>Stanze totali</h4>
            <p class="font-bold">{{apartment.rooms_number}}</p>
          </div>
          <div class="pr-32">
            <h4>Camere da letto</h4>
            <p class="font-bold">{{apartment.beds_number}}</p>
          </div>
          <div class="pr-32">
            <h4>Bagni</h4>
            <p class="font-bold">{{apartment.bath_number}}</p>
          </div>
          <div class="pr-32">
            <h4>Metri quadrati</h4>
            <p class="font-bold">{{apartment.meters}}</p>
          </div>
        </div>

        <div class="border rounded-lg p-6">
          <div class="flex">
            <h4 class="text-brand-500">{{apartment.price}} €</h4>
            <p> notte</p>
          </div>
          <div class="flex justify-between">
            <div>{{apartment.price}} x 5 notte</div>
            <div>{{fullPrice}}$</div>
          </div>
          <div class="flex justify-between">
            <div>Costi di pulizia</div>
            <div>12$</div>
          </div>
          <div class="flex justify-between">
            <div>Costi del servizio</div>
            <div>12$</div>
          </div>
          <hr>
          <div class="flex justify-between">
            <div>Totale</div>
            <div>12$</div>
          </div>
          <div class="flex justify-center drop-shadow-xl">
            <button class="text-white bg-brand-500 px-36 rounded-lg" >Prenota</button>
          </div>
        </div>

      </div>
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
  },
  computed: {
    fullPrice(){
      return this.apartment.price * 5
    }
  }
}
</script>

<style lang="scss" scoped>

</style>