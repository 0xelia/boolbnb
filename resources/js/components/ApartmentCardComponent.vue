<template>
    <div class="flex flex-col h-full">
        <figure class="flex-grow">
            <img class="w-full h-full object-cover object-center rounded-xl" :src="apartment.cover_path" alt="immagine appartamento">
        </figure>
        <span class="text-gray-700 text-xl font-bold py-2">{{apartment.title}}</span>
        <div class="flex justify-between">
            <span>
                {{apartment.address}}
            </span>

            <span>
                {{apartment.price}}
            </span>
        </div>
    </div>
</template>

<script>

export default {
    props:{
        apartment: Object,
    },
}
</script>

<style lang="scss" scoped>
    
</style>