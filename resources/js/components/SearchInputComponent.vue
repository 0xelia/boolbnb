<template>
    <div class="address-wrapper">
        <div ref="searchWrapper" class='flex flex-col gap-2 mb-4'>
            <label class="font-bold">Indirizzo *</label>
        </div>
        <div class="address-error"></div>

        <input class="p-2 flex-grow" type="hidden" name="address" v-model="address" maxlength="255" required>

        <input class="p-2 flex-grow" type="hidden" name="latitude" v-model="latitude">

        <input class="p-2 flex-grow" type="hidden" name="longitude" v-model="longitude">
    </div>
</template>


<script>

import axios from 'axios';
import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';


    export default{
        props: {
            apiKey: String,
        },
        data(){
            return{
                address: '',
                latitude: '',
                longitude: '',
                options: {
                    searchOptions: {
                        key: this.apiKey,
                        language: 'it-IT',
                        countrySet: 'IT',
                        limit: 15
                    },
                    autocompleteOptions: {
                        key: this.apiKey,
                        language: 'it-IT'
                    }
                },
                ttSearchBox: null,
                searchBoxHTML: null,
            }
        },
        methods: {
            getResult(result) {
                const res = result.data.result
                this.latitude = res.position.lat
                this.longitude = res.position.lng
                this.address = res.address.freeformAddress
                console.log(this.address)
            }
        },
        created() {
            this.ttSearchBox = new SearchBox(services, this.options);
            this.ttSearchBox.on('tomtom.searchbox.resultselected', this.getResult);
            this.searchBoxHTML = this.ttSearchBox.getSearchBoxHTML();
        },
        mounted() {
            this.$refs.searchWrapper.append(this.searchBoxHTML);
        },
    }
</script>

<style lang="scss" scoped></style>