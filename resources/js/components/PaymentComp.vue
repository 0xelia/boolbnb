<template>
    <div class="flex flex-col items-center content-center my-auto text-gray-500">
        <div v-if="(success === false)" class="static flex flex-col gap-7 items-center justify-center h-full">
            <div class="flex gap-5">
                <img src="https://cdn.worldvectorlogo.com/logos/visa.svg" class="w-15" alt="">
                <img src="https://cdn.worldvectorlogo.com/logos/mastercard-2.svg" class="w-15" alt="">
                <img src="https://cdn.worldvectorlogo.com/logos/american-express-1.svg" class="w-15" alt="">
            </div>
            <div class="flex flex-col">
                <label class="pb-2" for="name">Nome</label>
                <input class="outline-none border border-gray-300 px-6 py-3 rounded-xl" placeholder="Es. Marco Rossi" type="text" name="name" id="name">
            </div>
            <div class="flex flex-col">
                <label class="pb-2" for="card_number pb-2">Numero carta</label>
                <input v-model="creditCardNumber" class="outline-none cc-number border border-gray-300 px-6 py-3 rounded-xl" pattern="\d*" maxlength="19" type="text" name="card_number" id="card_number" placeholder="e.g. 4242 **** **** ****">
                
            </div>
            <div class="flex w-full justify-between">
                <div class="flex flex-col">
                    <span class="pb-2">Data</span>
                    <div class="exp-wrapper rounded-lg">
                        <input v-model="month" type="text" class="exp" name="month" id="month" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="MM">
                        <input v-model="year" type="text" class="exp" name="year" id="year" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="YY">
                    </div>
                    <div v-if="(error === true)" class="date_error text-sm text-red-600">Data non valida</div>
                </div>
                <div class="flex flex-col">
                    <span class="pb-2">CVV</span>
                    <div class="cvv flex items-center h-full border w-10 border-gray-300 rounded-lg">
                        <input v-model="cvv" class="outline-none text-center w-full" type="text" maxlength="3" name="cvv" id="cvv" placeholder="CVV">
                    </div>
                </div>
            </div>
            <button v-if="(success === false)" class="send p-3 rounded-full border-transparent text-white bg-blue-600" @click="expDate()">
                <i v-if="send" class="animate-spin fa-solid fa-circle-notch"></i> <span v-if="(send === false)"><i class="fa-solid fa-arrow-right"></i></span>
            </button>
            <div class="absolute bottom-10 text-red-600 font-semibold" v-if="(invalidInput === true)">
                Inserisci dati validi
            </div>
        </div>
        <div v-if="(success === true)" class="text-xl text-gray-700 font-semibold">
            Pagamento completato!
        </div>
        <div>
        </div>
    </div>    
</template>

<script>
    export default {

        props: {
            apartment: Object,
            id: Number,
            duration: Number,
        },


        data(){
            return{
                clientToken: '',
                status: '',
                month: '',
                year: '',
                error: false,
                creditCardNumber: '',
                cvv: '',
                success: false,
                invalidInput: false,
                send: false,
            }
        },
        methods: {
            fetchClientToken(){
                axios.get('/api/orders/generate')
                    .then(res => {
                        const {token} = res.data
                        this.clientToken = token
                    })
            },

            makePayment(){
                this.send = true
                axios.post('/api/orders/make/payment', {

                    'sponsor': this.id,
                    'apartment': this.apartment,

                }).then(res => {
                    const {status} = res
                    this.status = status
                    if(res.data.success){
                        this.success = true
                    }
                })
            },
            
            checkInput(){
                if(this.year && this.month && this.cvv && this.creditCardNumber) {
                    this.makePayment()
                    this.invalidInput = false
                } else {
                    this.invalidInput = true
                }
            },

            expDate(){
                const today = new Date();
                const month = today.getMonth();
                const year = today.getFullYear();
                console.log(year < this.year)

                if(this.year >= year) {
                    if(this.month >= month && this.month <= 12){
                        console.log('buona')
                        // this.error = false;
                        this.disabled = false;
                        this.makePayment();
                    } else {
                        console.log('scaduta')
                        // this.error = true
                    }
                } else {
                    // this.error = true
                }
            },

        },

        mounted(){
            this.fetchClientToken()
            
        },
        watch: {
            creditCardNumber() {
                let realNumber = this.creditCardNumber.replace(/-/gi, '')
                let dashedNumber = realNumber.match(/.{1,4}/g)
                this.creditCardNumber = dashedNumber.join('-')
            },
        }
    }
</script>

<style lang="scss" scoped>
.exp-wrapper {
  position: relative;
  border: 1px solid #aaa;
  display: flex;
  width: 100px;
  justify-content: space-around;
  height: 36px;
  line-height: 36px;
  font-size: 24px;
  
}

.exp-wrapper:after {
  content: '/';
  position: absolute;
  left: 50%;
  margin-left: -4px;
  color: #aaa;
}

input.exp {
  float: left;
  font-family: monospace;
  border: 0;
  width: 30px;
  outline: none;
  appearance: none;
  font-size: 14px;
  text-align: center;
}

.cvv{
    width: 100px;
}

.send{
    outline: none,
}

</style>