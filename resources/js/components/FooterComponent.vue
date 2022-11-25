<template>
    <footer class="text-sm py-3">
        <div class="container flex justify-between">
            <ul class="flex gap-5">
                <li v-for="(link, index) in links" :key="index">
                    <span v-if="index === 0">{{link}}</span>
                    <a v-else href="#">{{link}}</a>
                </li>
            </ul>
            <ul class="flex gap-5">
                <li v-for="(setting, index) in settings" :key="index">
                    <a href="#">{{setting.text}}</a>
                </li>
            </ul>
        </div>
    </footer>
</template>

<script>
export default {
    data() {
        return {
            links: ['© 2022 airbnb', 'Privacy', 'Termini', 'Destinazioni'],
            settings: [
                {
                    text: 'Italiano(IT)',
                    class: ''
                },
                {
                    text: 'EUR',
                    class: ''
                },
                {
                    text: 'Supporto e risorse',
                    class: ''
                },
            ],
        }
    }
    
}
</script>

<style lang="scss" scoped>
    
</style>