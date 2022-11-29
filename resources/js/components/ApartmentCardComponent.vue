<template>
    <div class="flex flex-col h-full">
        <figure class="flex-grow">
            <img class="w-full h-full object-cover object-center rounded-xl" :src="apartment.cover_path" alt="immagine appartamento">
        </figure>
        <span class="text-gray-700 text-xl font-bold py-2">{{apartment.title}}</span>
        <div class="flex justify-between">
            <span class="text-sm">
                {{apartment.address}}
            </span>

            <span>
                {{apartment.price}} &euro;
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
    img {
        aspect-ratio: 1;
    }
</style>