<template>
    <div>
        <div class="flex flex-col gap-2 mb-4">
            <label class="mr-2 font-bold" for="city">Città:</label>
            <input class="p-2 flex-grow" type="text" name="city"  id="city" placeholder="Inserisci la città" v-bind:value="city">

            </div>
        <div class="flex flex-col gap-2 mb-4">
            <label class="mr-2 font-bold" for="address">Indirizzo:</label>
            <input class="p-2 flex-grow" type="text" name="address" id="address" placeholder="Inserisci l'indirizzo" v-bind:value="address">

        </div>
    </div>
</template>


<script>
    export default{
        data(){
            return{
                city,
                address,
                baseUri: 'http://api.tomtom.com/search/2/geocode/'+ $params['address'] + ',' + $params['city'] + '.json?key=' + $key,
            }
        },
        methods: {
            fetchAddress(){
                axios.get(baseUri)
                .then((res)=>{
                    console.log(res)
                });
            }
        },
        watch: {
            address(a,b){
                if(a!=b){
                    this.fetchAddress()
                }
            },
            city(a,b){
                if(this.address){
                    if(a!=b){
                        this.fetchAddress()
                    }
                }
            }
        }
    }
</script>

<style lang="scss" scoped></style>