<template>
    <div>

        <div ref="search" @keyup="fetchAutocomplete" v-html="searchBoxHTML.innerHTML"></div>

        <div class="flex flex-col gap-2 mb-4">
            <label class="mr-2 font-bold" for="address">Indirizzo:</label>
            <input class="p-2 flex-grow" @keyup="fetchAutocomplete" type="text" name="address" id="address" placeholder="Inserisci l'indirizzo" >
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
                apiKey: 'as0gbWig8K0G3KPY9VcGrsNm44fzb73h',
                address: 'via roma',
                latitude: '',
                longitude: '',
                baseUrl: 'https://api.tomtom.com/search/2/search',
                options: {
                    searchOptions: {
                        key: 'as0gbWig8K0G3KPY9VcGrsNm44fzb73h',
                        language: 'it-IT',
                        limit: 15
                    },
                    autocompleteOptions: {
                        key: 'as0gbWig8K0G3KPY9VcGrsNm44fzb73h',
                        language: 'it-IT'
                    }
                },
                ttSearchBox: null,
                searchBoxHTML: null,
            }
        },
        // watch: {
        //     address(a, b) {
        //         if (a != b) {
        //             const inputEl = document.querySelector('.tt-search-box-input');
        //             inputEl.setAttribute('value', this.address);
        //             console.log(inputEl);
        //         }
        //     }
        // },
        methods: {
            fetchAddress(){
                if(this.address) {
                    axios.get(this.baseUri + 'geocode/' + this.address + '.json?key=' + this.apiKey)
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
            fetchAutocomplete() {
                axios.get(`${this.baseUrl}/${this.address}.json?limit=${this.options.searchOptions.limit}&language=${this.options.searchOptions.language}&key=${this.apiKey}`)
                    .then(res => console.log(res)
                );
            }
        },
        created() {
            this.ttSearchBox = new SearchBox(services, this.options)
            this.searchBoxHTML = this.ttSearchBox.getSearchBoxHTML()
        },
        mounted() {
            const inputEl = this.$refs.search.children[0].children[2];
            inputEl.setAttribute('value', this.address);
        }
    }
</script>

<style lang="scss" scoped></style>