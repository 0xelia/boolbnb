<template>
    <div>
        <figure class="overflow-hidden flex-grow rounded-xl">
            <img class="w-full h-full object-cover object-center" :src="apartment.cover_path" alt="immagine appartamento">
            <p>
                {{apartment.title}}
            </p>
        </figure>
        <div>
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
    name: 'ApartmentCard',
    props:{
        apartment: Object,
    },
    mounted() {
        console.log(this.apartment)
    }
}
</script>

<style lang="scss" scoped>
    
</style>