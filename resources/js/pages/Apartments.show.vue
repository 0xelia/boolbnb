<template>
  <div class="container">
      <div class="text-brand-500 py-7"><i class="fa-solid fa-chevron-left"></i> Torna alla pagina di ricerca</div>
      <div v-if="apartment" class="font-semibold text-5xl">
        <h2 class="text-black">
          {{ apartment.title }}
        </h2>
      </div>
      <div class="py-4 pb-8">
        {{ apartment.address }}
      </div>
      <div class="md:grid gallery md:grid-cols-3 md:grid-rows-2 gap-6 pb-12">
          <img class="md:object-cover md:w-full md:h-full rounded-xl md:col-span-2 md:row-span-2" :src="apartment.pic_path" alt="">
          <img class="invisible md:visible md:object-cover md:w-full md:h-full rounded-xl md:row-span-1 md:col-span-1" v-for="(img, i) in apartment.images" :key="i" :src="img.img_path" alt="">
      </div>

      <div class="grid md:grid-cols-3 gap-6 pb-20">
        <div class=" border flex lg:justify-start p-6 content-center rounded-lg col-span-3 md:col-span-3 row-span-3 lg:row-start-1 lg:col-span-2 md:row-span-2 lg:row-span-1 h-24 justify-center">
          <div class="pr-13  lg:pr-16 self-center">
            <h4 class="pb-1">Stanze totali</h4>
            <p class="font-bold text-center text-black">{{apartment.rooms_number}}</p>
          </div>
          <div class="pr-13  lg:pr-16 self-center">
            <h4 class="pb-1">Camere da letto</h4>
            <p class="font-bold text-center text-black">{{apartment.beds_number}}</p>
          </div>
          <div class="pr-13  lg:pr-16 self-center">
            <h4 class="pb-1">Bagni</h4>
            <p class="font-bold text-center text-black">{{apartment.bath_number}}</p>
          </div>
          <div class="pr-13  lg:pr-16 self-center ">
            <h4 class="pb-1">Metri quadrati</h4>
            <p class="font-bold text-center text-black">{{apartment.meters}}</p>
          </div>
        </div>

        <div class="border rounded-lg p-6 md:col-span- col-span-3 lg:row-span-2 h-96 lg:col-span-1 drop-shadow-xl">
          <div class="flex pb-8">
            <h4 class="text-brand-500 text-2xl font-bold">{{apartment.price}} € &nbsp; </h4>
            <p class="self-center">notte</p>
          </div>
          <div class="flex justify-between pb-8">
            <div>{{apartment.price}} x 5 notti</div>
            <div>{{apartment.price * 5}} &nbsp; $</div>
          </div>
          <div class="flex justify-between pb-8">
            <div>Costi di pulizia</div>
            <div>{{Math.round((apartment.price * 5)*0.5/100*100)/100}} &nbsp; $</div>
          </div>
          <div class="flex justify-between pb-8">
            <div>Costi del servizio</div>
            <div>{{Math.round((apartment.price * 5)*2/100*100)/100}} &nbsp; $</div>
          </div>
          <hr class="pb-8">
          <div class="flex justify-between pb-8">
            <div class="font-bold">Totale</div>
            <div class="font-bold">{{Math.round((apartment.price * 5 + (apartment.price * 5)*0.5/100 + (apartment.price * 5)*2/100)*100)/100}} &nbsp; $</div>
          </div>
          <div class="flex justify-center">
            <button class="text-white bg-brand-500 w-4/5 h-12 rounded-md">Prenota</button>
          </div>
        </div>

        <div class="border col-span-3 md:row-span-1 lg:row-span-2 lg:col-span-2">
          <p class="text-2xl font-semibold text-black">Cosa troverai</p>
          <ul class="flex gap-8">
            <li v-for="(service, i) in apartment.services" :key="i">
              {{service.name}}
            </li>
          </ul>
        </div>


      </div>

      <div>
        <p class="text-2xl font-semibold text-black">
          Dove ti troverai
        </p>

        <!-- ********  QUI VA LA MAPPA ******** -->

        <div>
          <div></div>
        </div>
      </div>

      <p class="text-2xl font-semibold text-black">
          Lascia un messaggio
        </p>

        <!-- POPUP MESSAGE SUCCEED -->
        <div v-if="popup" class="fixed popup_wrapper inset-x-0 inset-y-0  flex justify-center items-center">
          <div class="flex px-3 py-6 rounded-xl bg-white text-brand-500 text-bold">
            Messaggio Inviato correttamente!
          </div>
        </div>

      <div class="flex items-center justify-center">
        <!-- Author: FormBold Team -->
        <!-- Learn More: https://formbold.com -->
        <div class="mx-auto w-full max-w-[550px]">
            <div class="mb-5">
              <label
                for="name"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Nome
              </label>
              <input
                type="text"
                v-model="msgName"
                name="name"
                id="name"
                placeholder="Nome"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              />
            </div>
            <div class="mb-5">
              <label
                for="name"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Cognome (Opzionale)
              </label>
              <input
                type="text"
                name="name"
                v-model="msgLastname"
                id="name"
                placeholder="Cognome"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              />
            </div>
            <div class="mb-5">
              <label
                for="email"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Email
              </label>
              <input
                type="email"
                name="email"
                v-model="msgEmail"
                required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$"
                id="email"
                placeholder="esempio@mail.com"
                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              />
            </div>

            <div class="mb-5">
              <label
                for="message"
                class="mb-3 block text-base font-medium text-[#07074D]"
              >
                Messaggio
              </label>
              <textarea
                v-model="msgTxt"
                rows="4"
                name="message"
                id="message"
                placeholder="Inserisci il tuo messaggio"
                class="w-full resize-none rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
              ></textarea>
            </div>
            <div>
              <button @click="submitMessage()"
                class=" bg-brand-500 hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-base font-semibold text-white">
                Invia all'host
              </button>
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
      apartment: '',
      msgName: '',
      msgLastname: '',
      msgEmail: '',
      msgTxt: '',
      popup: false,
    }
  },
  methods: {
    fetchDetails() {
      axios.get(`/api/apartments/${this.id}`)
        .then(res => {
          const { apartment } = res.data
          this.apartment = apartment

          this.addActive(this.apartment)

          console.log(this.apartment);
        })
    },

    addActive(apartment){
      apartment.IsActive = false
      return apartment
    },

    submitMessage(){

      if(this.msgName && this.msgEmail && this.msgTxt){

        axios.post(`/api/messages/`,{
          name: this.msgName,
          surname: this.msgLastname,
          email: this.msgEmail,
          text: this.msgTxt,
          apartment_id: this.id

        }).then(res => { 

          this.popup = true
          this.msgName = ''
          this.msgLastname = ''
          this.msgTxt = ''
          this.msgEmail = ''
          
          setTimeout(()=>{
            this.popup = false

          },2000)

        }).catch(err => {
          const {response} = err.request
          this.errors = JSON.parse(response)
        })

      }else{
        return alert('Compila i campi mancanti!')
      }
    }
  },
  created() {
    this.fetchDetails()
  },
}
</script>

<style lang="scss" scoped>
  .gallery{
    height: 476px;
  }

  .popup_wrapper{
    backdrop-filter: blur(20px);
    background-color: rgba(255, 255, 255, 0.494);
  }

</style>