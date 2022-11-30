<template>
    <header class="py-7">
        <div class="container flex items-center justify-between">
            <div class="text-brand-500 text-xl">airbnb</div>
            <nav>
                <ul class="flex gap-6">
                    <li v-for="(link, index) in links" :key="index">
                        <a :href="link.name">{{link.text}}</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<script>
export default {
    data() {
        return {
            user: this.$root.user,
            links: [
                {
                    text: 'Login',
                    name: 'login'
                },
                {
                    text: 'Register',
                    name: 'register'
                }
            ]
        }
    }
    
}
</script>

<style lang="scss" scoped>

</style>