<template>
    <div>
        <div ref="searchWrapper">
            <label>Indirizzo</label>
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
                address: '',
                latitude: '',
                longitude: '',
                baseUrl: 'https://api.tomtom.com/search/2/search',
                options: {
                    searchOptions: {
                        key: 'as0gbWig8K0G3KPY9VcGrsNm44fzb73h',
                        language: 'it-IT',
                        countrySet: 'IT',
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
        methods: {
            fetchAutocomplete() {
                axios.get(`${this.baseUrl}/${this.address}.json?limit=${this.options.searchOptions.limit}&countrySet=${this.options.searchOptions.countrySet}&language=${this.options.searchOptions.language}&key=${this.apiKey}`)
                    .then(res => console.log(res)
                );
            }
        },
        created() {
            this.ttSearchBox = new SearchBox(services, this.options);
            this.searchBoxHTML = this.ttSearchBox.getSearchBoxHTML();
        },
        mounted() {
            this.$refs.searchWrapper.append(this.searchBoxHTML);
        }
    }
</script>

<style lang="scss" scoped></style>