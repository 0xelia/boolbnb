<template>
    <div>
        <v-braintree
            :authorization="authorization"
            @success="onSuccess"
            @error="onError"
            locale="it_IT"
        />
    </div>
</template>

<script>
    /*import Vue from 'vue'
    import vue-braintree from 'vue-braintree'

    Vue.use(vue-braintree)*/

    export default{
        props:{
            authorization:{
                required: true,
                type: String
            }
        },
        methods: {
            onSuccess (payload) {
                let nonce = payload.nonce;
                // Do something great with the nonce...
            },
            onError (error) {
                let message = error.message;
                // Whoops, an error has occured while trying to get the nonce
            }
        },
    }
</script>