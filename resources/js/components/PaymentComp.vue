<template>
    <div class="flex flex-col gap-6 items-center justify-center h-full">
        <div class="flex gap-5">
            <img src="https://cdn.worldvectorlogo.com/logos/visa.svg" class="w-15" alt="">
            <img src="https://cdn.worldvectorlogo.com/logos/mastercard-2.svg" class="w-15" alt="">
            <img src="https://cdn.worldvectorlogo.com/logos/american-express-1.svg" class="w-15" alt="">
        </div>
        <div class="flex flex-col">
            <label for="name pb-2">Nome</label>
            <input class="border border-gray-300 px-6 py-3 rounded-xl" type="text" name="name" id="name">
        </div>
        <div class="flex flex-col">
            <label for="card_number pb-2">Numero carta</label>
            <input v-model="creditCardNumber" class="cc-number border border-gray-300 px-6 py-3 rounded-xl" pattern="\d*" maxlength="19" type="text" name="card_number" id="card_number" placeholder="e.g. 4242 **** **** ****">
            
        </div>
        <div class="flex w-full justify-between">
            <div class="flex flex-col">
                <span>Data</span>
                <div class="exp-wrapper rounded-lg">
                    <input v-model="month" type="text" class="exp" name="month" id="month" maxlength="2" pattern="[0-9]*" inputmode="numerical" placeholder="MM">
                    <input @focusout="expDate" v-model="year" type="text" class="exp" name="year" id="year" maxlength="4" pattern="[0-9]*" inputmode="numerical" placeholder="YY">
                </div>
                <div v-if="(error === true)" class="date_error text-sm text-red-600">Data non valida</div>
            </div>
            <div class="flex flex-col">
                <span>CVV</span>
                <div class="flex items-center h-full border w-10 border-gray-300 rounded-lg">
                    <input v-model="cvv" class="outline-none w-9 text-center" type="text" maxlength="3" name="cvv" id="cvv" placeholder="CVV">
                </div>
            </div>
        </div>
        <div>
            <button :disabled="disabled" :class="disabled === true ? 'bg-blue-300' : 'bg-blue-600'" class="p-3 rounded-lg  text-white" @click="makePayment()">
                Submit
            </button>
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
                disabled: true,
                creditCardNumber: null,
                cvv: null,
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
                axios.post('/api/orders/make/payment', {

                    'sponsor': this.id,
                    'apartment': this.apartment,

                }).then(res => {
                    const {status} = res

                    this.status = status

                    console.log(res.data)
                })
            },

            expDate(){
                const today = new Date();
                const month = today.getMonth();
                const year = today.getFullYear();

                if(this.year >= year) {
                    if(this.month >= month && this.month <= 12){
                        console.log('buona')
                        this.error = false;
                        this.disabled = false;
                    } else {
                        console.log('scaduta')
                        this.error = true
                    }
                } else {
                    this.error = true
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
            }
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

</style>