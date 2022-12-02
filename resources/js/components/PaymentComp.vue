<template>
    <div class="flex flex-col items-center content-center my-auto text-gray-500">
        <div v-if="(response === null)" class="static flex flex-col gap-7 items-center justify-center h-full">
            <div class="flex gap-5">
                <img src="https://cdn.worldvectorlogo.com/logos/visa.svg" class="w-15" alt="">
                <img src="https://cdn.worldvectorlogo.com/logos/mastercard-2.svg" class="w-15" alt="">
                <img src="https://cdn.worldvectorlogo.com/logos/american-express-1.svg" class="w-15" alt="">
            </div>
            <div class="flex flex-col">
                <label class="pb-2" for="name">Nome</label>
                <input v-model="nameCard" :class="nameCheck ? 'border-red-700' : 'border-gray-300'" class="outline-none border border-gray-300 px-6 py-3 rounded-xl" placeholder="Es. Marco Rossi" type="text" name="name" id="name">
            </div>
            <div class="flex flex-col">
                <label class="pb-2" for="card_number pb-2">Numero carta</label>
                <input v-model="creditCardNumber" :class="cardCheck ? 'border-red-700' : 'border-gray-300'" c class="outline-none cc-number border px-6 py-3 rounded-xl" pattern="\d*" maxlength="19" type="text" name="card_number" id="card_number" placeholder="e.g. 4242 **** **** ****">
            </div>
            <div class="flex w-full justify-between">
                <div class="flex flex-col">
                    <span class="pb-2">Data</span>
                    <div :class="dataCheck ? 'border-red-700' : 'border-gray-300'" class="border exp-wrapper rounded-lg">
                        <input v-model="month" type="text" class="exp" name="month" id="month" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="MM">
                        <input v-model="year" type="text" class="exp" name="year" id="year" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="YY">
                    </div>
                </div>
                <div class="flex flex-col">
                    <span class="pb-2">CVV</span>
                    <div :class="cvvCheck ? 'border-red-700' : 'border-gray-300'" class="cvv flex items-center h-full border w-10 border-gray-300 rounded-lg">
                        <input v-model="cvv" inputmode="numerical" class="cvvInput outline-none text-center w-full" type="text" pattern="\d*" maxlength="3" name="cvv" id="cvv" placeholder="CVV">
                    </div>
                </div>
            </div>
            <button v-if="(response === null)" class="send p-3 rounded-full border-transparent text-white bg-brand-500" @click="checkInput()">
                <i v-if="send" class="animate-spin fa-solid fa-circle-notch"></i> <span v-if="(send === false)"><i class="fa-solid fa-arrow-right"></i></span>
            </button>
            <div class="absolute bottom-10 text-red-600 font-semibold" v-if="(invalidInput === true)">
                Inserisci dati validi
            </div>
        </div>
        <div v-if="response" class="text-xl text-center text-gray-700 font-semibold">
            {{response.message}}
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
                month: '',
                year: '',
                nameCard: '',
                dataCheck: false,
                cvvCheck: false,
                cardCheck: false,
                nameCheck: false,
                creditCardNumber: '',
                cvv: '',
                success: null,
                fail: false,
                invalidInput: false,
                send: false,
                response: null,
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
                    const { data } = res
                    this.response = data
                })
            },
            
            checkInput(){
                if(this.year && this.month && this.cvv && this.creditCardNumber) {
                    this.checkName()
                    this.checkCardNumber()
                    this.expDate()
                    this.checkCvv()
                    if(!this.dataCheck && !this.cvvCheck && !this.cardCheck && !this.nameCheck) {
                        this.makePayment()
                        this.invalidInput = false
                    } else {
                        this.invalidInput = true
                    }
                } else {
                    this.invalidInput = true
                }
            },

            expDate(){
                const today = new Date();
                const month = today.getMonth();
                const year = String(today.getFullYear());
                const yy = parseInt(year.slice(-2))

                if(this.year > yy) {
                    if(this.month <= 12){
                        this.dataCheck = false
                    } else {
                        this.dataCheck = true
                    }
                } else if(this.year == yy) {
                    if(this.month >= month && this.month <= 12) {
                        this.dataCheck = false
                    } else {
                        this.dataCheck = true
                    }
                } else {
                    this.dataCheck = true
                }
            },

            checkCvv(){           
                const n = this.cvv
                if(n.length === 3) {
                    if(n.match(/^[0-9]+$/) == null) {
                        this.cvvCheck = true
                    } else {
                        this.cvvCheck = false
                    }
                } else {
                    this.cvvCheck = true
                }
            },

            checkCardNumber(){
                const card = this.creditCardNumber
                console.log(card)
                const newCard = card.replace(/-/g, '')
                if(newCard.length === 16){
                    if(newCard.match(/^[0-9]+$/) == null) {
                        this.cardCheck = true
                    } else {
                        this.cardCheck = false
                    }
                } else {
                    this.cardCheck = true
                }
            },

            checkName(){
                const name = this.nameCard
                const newName = name.replace(/ /g, '')
                if(newName.match(/^[A-Za-z]+$/) == null) {
                    this.nameCheck = true
                } else {
                    this.nameCheck = false
                }
            }
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
    width: 120px;
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

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
}

.send{
    outline: none,
}

</style>