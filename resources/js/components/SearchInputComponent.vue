<template>
    <div class="address-wrapper">
        <div ref="searchWrapper" class='flex flex-col gap-2 mb-4 relative'>
            <label for="address" class="font-bold">Indirizzo *</label>
            <input @input="fetchResult" type="text" name="address" id="address" v-model="address" class="address p-2 flex-grow" placeholder="Inserisci un indirizzo">
            <ul class="absolute w-full rounded bg-white results-list" v-if="results">
                <li @click="getResult(result)" v-for="(result, index) in results" :key="index" class="result cursor-pointer px-2 py-3">
                    {{result.address.freeformAddress}}
                </li>
            </ul>
        </div>
        <div class="address-error"></div>

        <input class="p-2 flex-grow" type="hidden" name="latitude" v-model="latitude">

        <input class="p-2 flex-grow" type="hidden" name="longitude" v-model="longitude">
    </div>
</template>


<script>

    export default{
        data(){
            return{
                tomtomApiUrl: 'https://api.tomtom.com/search/2/search/',
                typeahead: true,
                limit: 5,
                language: "it-IT",
                countrySet: "IT",
                minFuzzyLevel: 1,
                maxFuzzyLevel: 2,
                address: '',
                latitude: '',
                longitude: '',
                results: null,
            }
        },
        methods: {
            fetchResult() {
                if(this.address) {
                    axios.get("/api/search/".concat(this.address))
                        .then(res => {
                            const { results } = res.data
                            this.results = results.results
                            this.visible = true
                        })       
                        .catch(err => {
                            this.results = null
                        })  
                    axios.interceptors.response.use(response => {
                        if(this.address) {
                            return response
                        } else {
                            this.results = null
                        }
                    }, error => {
                        return Promise.reject(error)
                    })           
                }
            },
            getResult(result) {
                this.visible = false
                this.latitude = result.position.lat
                this.longitude = result.position.lon
                this.address = result.address.freeformAddress
                console.log(this.address, this.latitude, this.longitude)
            }
        }
    }
</script>

<style lang="scss" scoped>
.results-list {
    top: 70px;
    border: 2px solid black;
    .result {
        &:hover {
            background-color: lightgray;
        }
    }
}
</style>