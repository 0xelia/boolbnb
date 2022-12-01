<template>
    <header>
        <div class="container">
            <div class="flex items-center h-20">
                <a href="/" class="text-brand-500 text-xl">airbnb</a>
                <nav class="ml-auto">
                    <div>
                        <a v-if="user" href="admin/apartments" class="no-underline hover:underline">I miei appartamenti</a>
                        <template v-else>
                            <a href="login" class="no-underline hover:underline pr-6">Login</a>
                            <a href="register" class="no-underline hover:underline">Register</a>
                        </template>
                    </div>
                </nav>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    data() {
        return {
            user: this.$root.user,
        }
    }
}
</script>

<style lang="scss" scoped>

</style>