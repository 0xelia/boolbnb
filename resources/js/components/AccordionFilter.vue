<template>
    <div class="py-6">
        <div class="flex justify-between gap-4">
            <h3>{{ info.title }}</h3>
            <i class="fa-solid fa-plus"></i>
        </div>
        <ul class="mt-6 flex flex-col gap-4">
            <li v-for="(field, i) in fields" :key="i" class="flex gap-3">
                <input :type="info.type" :name="info.name" :id="field.id">
				<label :for="field.id">{{ field.label }}</label>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        info: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            fields: this.info.filters
        }
    }
}
</script>

<style lang="scss" scoped>

</style>