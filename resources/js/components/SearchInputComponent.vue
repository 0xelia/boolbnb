<template>
    <div>
        <div class="flex flex-col gap-2 mb-4">
            <label class="mr-2 font-bold" for="city">Città:</label>
            <input class="p-2 flex-grow" type="text" name="city"  id="city" placeholder="Inserisci la città" v-model="city">

            </div>
        <div class="flex flex-col gap-2 mb-4">
            <label class="mr-2 font-bold" for="address">Indirizzo:</label>
            <input class="p-2 flex-grow" type="text" name="address" id="address" placeholder="Inserisci l'indirizzo" v-model="address">

        </div>
    </div>
</template>


<script>

import axios from 'axios';

    export default{
        data(){
            return{
                key: 'as0gbWig8K0G3KPY9VcGrsNm44fzb73h',
                city: '',
                address: '',
                baseUri: 'https://api.tomtom.com/search/2/geocode/',
            }
        },
        methods: {
            fetchAddress(){
                
                axios.get(this.baseUri + this.address + ',' + this.city + '.json?key=' + this.key)
                .then((res)=>{
                    console.log(res)
                });
            }
        },
        watch: {
            address(a,b){
                console.log('via')
                if(a != b){
                    this.fetchAddress()
                }
            },
            city(a,b){
                console.log('via')
                if(this.address){
                    if(a != b){
                        this.fetchAddress()
                    }
                }
            }
        }
    }
</script>

<style lang="scss" scoped></style>