<template>
    <div class="address-wrapper">
        <div ref="searchWrapper" class='flex flex-col gap-2 mb-4 relative'>
            <label for="address" class="font-bold">Indirizzo *</label>
            <input @keyup="fetchResult" type="text" name="address" id="address" v-model="address" class="address p-2 flex-grow" placeholder="Inserisci un indirizzo" autocomplete="off">
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
        props: ['addr'],
        data(){
            return{
                tomtomApiUrl: 'https://api.tomtom.com/search/2/search/',
                typeahead: true,
                limit: 5,
                language: "it-IT",
                countrySet: "IT",
                minFuzzyLevel: 1,
                maxFuzzyLevel: 2,
                latitude: '',
                longitude: '',
                address: this.addr ? this.addr : '',
                results: null,
            }
        },
        methods: {
            fetchResult() {
                if(this.address) {
                    axios.get("/api/search/".concat(this.address))
                        .then(res => {
                            const { results } = res.data
                            this.results = results.results.filter(result => {
                                return result.type != 'Cross Street'
                            })
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
                } else {
                    this.results = null
                    this.latitude = null
                    this.longitude = null                    
                    // this.$emit('positionSelected', [
                    //     this.latitude,
                    //     this.longitude
                    // ])
                    this.getResult(this.results)
                }
            },
            getResult(result) {
                this.results = null
                this.latitude = result ? result.position.lat : result
                this.longitude = result ? result.position.lon : result
                this.address = result ? result.address.freeformAddress : result
                // if(this.$route.name === 'advanced-search') {
                //     this.$router.push({ path: '/ricerca-avanzata', query: {
                //         lat: this.latitude,
                //         lon: this.longitude,
                //         addr: this.address
                //     } })
                // }
                if(this.$route.name === 'home' || this.$route.name === 'advanced-search') {
                    this.$router.push({ path: '/ricerca-avanzata', query: {
                        lat: this.latitude,
                        lon: this.longitude,
                        addr: this.address
                    } })
                }
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