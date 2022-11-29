<template>
    <div>
        <v-braintree
            authorization="sandbox_s9m8th2b_6thm2yxvhq57thys"
            @success="onSuccess"
            @error="onError"
            locale="it_IT"
        />
    </div>
    <div></div>
</template>

<script>
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