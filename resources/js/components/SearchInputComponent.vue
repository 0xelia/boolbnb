<template>
    <div>

        <div @keyup="fetchAutocomplete" v-html="searchBoxHTML.innerHTML"></div>

        <div class="flex flex-col gap-2 mb-4">
            <label class="mr-2 font-bold" for="address">Indirizzo:</label>
            <input class="p-2 flex-grow" @keyup="fetchAutocomplete" type="text" name="address" id="address" placeholder="Inserisci l'indirizzo" v-model="address">
        </div>

        <input class="p-2 flex-grow" type="hidden" name="latitude" v-model="latitude">

        <input class="p-2 flex-grow" type="hidden" name="longitude" v-model="longitude">
    </div>
</template>


<script>

import axios from 'axios';
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';


    export default{
        data(){
            return{
                key: 'as0gbWig8K0G3KPY9VcGrsNm44fzb73h',
                address: '',
                latitude: '',
                longitude: '',
                baseUri: 'https://api.tomtom.com/search/2/',
                options: {
                    searchOptions: {
                        key: this.key,
                        language: 'it-IT',
                        limit: 5
                    },
                    autocompleteOptions: {
                        key: this.key,
                        language: 'it-IT'
                    }
                },
                ttSearchBox: null,
                searchBoxHTML: null,
            }
        },
        methods: {
            fetchAddress(){
                if(this.address) {
                    axios.get(this.baseUri + 'geocode/' + this.address + '.json?key=' + this.key)
                    .then((res)=>{
                        res.data.results.forEach(result => {
                            if(result.address.postalCode === this.cap) {
                                this.latitude = result.position.lat
                                this.longitude = result.position.lon
                            }
                        });
                    });
                }
            },
            fetchAutocomplete(){
                axios.get(this.baseUri + 'autocomplete/' + this.address + '.json?key=' + this.key + '&language=it-IT')
                .then((res) => {
                    console.log(res)
                })
            }
        },
        created(){
            this.ttSearchBox = new SearchBox(services, this.options)
            this.searchBoxHTML = this.ttSearchBox.getSearchBoxHTML()
            console.log(this.searchBoxHTML.innerHTML)
        }
    }
</script>

<style lang="scss" scoped></style>