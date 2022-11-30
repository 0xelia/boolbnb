<template>
    <div>
        
    </div>
</template>

<script>
    export default {
        props:['id'],
        data(){
            return{
                clientToken: '',
            }
        },

        methods: {
            fetchClientToken(){
                axios.get('/api/orders/generate')
                    .then(res => {
                        const {token} = res.data
                        this.clientToken = token

                        console.log(this.clientToken)
                    })
            },

            makePayment(){
                axios.post('/api/orders/make/payment', {
                    'sponsor': 3,
                    'apartment_id': id
                }).then(res => {
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