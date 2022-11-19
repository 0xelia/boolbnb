<template>
    <div>
        <div class="flex flex-col gap-2 mb-4">
            <label class="mr-2 font-bold" for="city">Città:</label>
            <input class="p-2 flex-grow" @blur="fetchAddress" type="text" name="city"  id="city" placeholder="Inserisci la città" v-model="city">
        </div>
        <div class="flex flex-col gap-2 mb-4">
            <label class="mr-2 font-bold" for="address">Indirizzo:</label>
            <input class="p-2 flex-grow" @blur="fetchAddress" type="text" name="address" id="address" placeholder="Inserisci l'indirizzo" v-model="address">
        </div>
        <div class="flex flex-col gap-2 mb-4">
            <label class="mr-2 font-bold" for="address">Cap:</label>
            <input class="p-2 flex-grow" @blur="fetchAddress" type="text" name="cap" id="cap" placeholder="Inserisci il cap" v-model="cap">
        </div>

        <input class="p-2 flex-grow" type="hidden" name="latitude" v-model="latitude">

        <input class="p-2 flex-grow" type="hidden" name="longitude" v-model="longitude">
    </div>
</template>


<script>

import axios from 'axios';

    export default{
        data(){
            return{
                key: 'as0gbWig8K0G3KPY9VcGrsNm44fzb73h',
                city: '',
                cap: '',
                address: '',
                latitude: '',
                longitude: '',
                baseUri: 'https://api.tomtom.com/search/2/geocode/',
            }
        },
        methods: {
            fetchAddress(){
                if(this.city && this.address && this.cap) {
                    axios.get(this.baseUri + this.address + ',' + this.city + '.json?key=' + this.key)
                    .then((res)=>{
                        res.data.results.forEach(result => {
                            if(result.address.postalCode === this.cap) {
                                this.latitude = result.position.lat
                                this.longitude = result.position.lon
                            }
                        });
                    });
                }
            }
        },
    }
</script>

<style lang="scss" scoped></style>