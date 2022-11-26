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
      <div class="grid gallery grid-cols-3 grid-rows-2 gap-6 pb-12">
          <img class="object-cover w-full h-full rounded-xl col-span-2 row-span-2" :src="apartment.image" alt="">
          <img class="object-cover w-full h-full rounded-xl row-span-1 col-span-1" src="https://picsum.photos/200/300" alt="">
          <img class="object-cover w-full h-full rounded-xl row-span-1 col-span-1" src="https://picsum.photos/200/300" alt="">
      </div>

      <div class="grid grid-cols-3 grid-rows-2 gap-6">
        <div class="border flex content-center rounded-lg col-span-2 row-span-1 h-24 justify-center">
          <div class="pr-32 pb-3">
            <h4>Stanze totali</h4>
            <p class="font-bold">{{apartment.rooms_number}}</p>
          </div>
          <div class="pr-32 pb-3">
            <h4>Camere da letto</h4>
            <p class="font-bold">{{apartment.beds_number}}</p>
          </div>
          <div class="pr-32 pb-3">
            <h4>Bagni</h4>
            <p class="font-bold">{{apartment.bath_number}}</p>
          </div>
          <div class="pr-32 pb-3">
            <h4>Metri quadrati</h4>
            <p class="font-bold">{{apartment.meters}}</p>
          </div>

        </div>

        <div class="border rounded-lg p-6 row-span-3 h-96 col-span-1">
          <div class="flex pb-8">
            <h4 class="text-brand-500">{{apartment.price}} €  </h4>
            <p>notte</p>
          </div>
          <div class="flex justify-between pb-8">
            <div>{{apartment.price}} x 5 notte</div>
            <div>{{apartment.price * 5}}$</div>
          </div>
          <div class="flex justify-between pb-8">
            <div>Costi di pulizia</div>
            <div>12$</div>
          </div>
          <div class="flex justify-between pb-8">
            <div>Costi del servizio</div>
            <div>12$</div>
          </div>
          <hr class="pb-8">
          <div class="flex justify-between pb-8">
            <div>Totale</div>
            <div>12$</div>
          </div>
          <div class="flex justify-center drop-shadow-xl">
            <button class="text-white bg-brand-500 px-36 rounded-lg" >Prenota</button>
          </div>
        </div>

        <div class="row-span-1 col-span-1 text-left">
            <h3 class="section-title">Cosa troverai</h3>
            <div class="grid grid-cols-2 gap-6">
              <div class="ml-10">
                <p>{{apartment.services}}</p>
                <p>{{}}</p>
              </div>
              <div class="ml-10">
                <p>{{}}</p>
                <p>{{}}</p>
              </div>
            </div>
          </div>
      </div>
      <div>
        <h3>
          Dove ti troverai
        </h3>
      </div>

  </div>
</template>

<script>
export default {
  props: ['id'],
  data() {
    return {
      apartment: []
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
}
</script>

<style lang="scss" scoped>
  .gallery{
    height: 476px;
  }

  h3{
    font-size: large;
  }

</style>