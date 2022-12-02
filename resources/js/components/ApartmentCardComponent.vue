<template>
    <div class="flex flex-col h-full relative">
        <figure class="pb-2/3 relative">
            <img class="absolute w-full h-full object-cover object-center rounded-xl" :src="apartment.pic_path" alt="immagine appartamento">
        </figure>
        <span class="text-gray-700 text-xl font-bold py-2">{{apartment.title}}</span>
        <div class="flex justify-between">
            <span class="text-sm">
                {{apartment.address}}                
            </span>

            <span class="whitespace-no-wrap">
                {{apartment.price}} &euro;
            </span>
        </div>
        <div v-if="(distance !== undefined)" class="text-sm">
            Dista {{distance}} km
        </div>
        <div class="absolute sponsored" v-if="checkDate(apartment)">
            <p>In evidenza</p>
        </div>
    </div>
</template>

<script>

export default {
    props:{
        apartment: Object,
        distance: Number,
    },
    methods: {
        checkDate(apartment) {
            let date = false
            if(apartment.sponsors.length > 0) {
                date = apartment.sponsors[0].pivot.expire_date
                if(date) {
                    const now = new Date()
                    date = new Date(date)
                    date = now < date ? date : null
                }
            }
            return date
        }
    },   
}
</script>

<style lang="scss" scoped>
    img {
        aspect-ratio: 1;
    }
    .sponsored {
        top: 5px;
        right: 5px;
        background-color: rgba($color: #ff385c, $alpha: 0.7);
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 10px;
    }
</style>