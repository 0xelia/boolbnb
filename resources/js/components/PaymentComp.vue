<template>
    <div class="flex flex-col gap-6 items-center justify-center h-full">
        <input class="border border-gray-300 px-6 py-3 rounded-xl" type="number" name="card_number" id="card_number" placeholder="e.g. 4242 **** **** ****">
        <button @click="makePayment()">
            submit
        </button>
    </div>
</template>

<script>
    export default {

        props: {
            apartment: Object,
            id: Number
        },


        data(){
            return{
                clientToken: '',
                status: ''
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
            }
        },

        mounted(){
            this.fetchClientToken()
        }
    }
</script>

<style lang="scss" scoped>

</style>