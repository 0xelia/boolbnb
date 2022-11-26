<template>
    <div class="accordion py-6 border-t border-gray-300">
        <div @click="toggleFilters" class="py-6 -my-6 flex justify-between gap-4">
            <h3 class="text-gray-700">{{ info.title }}</h3>
            <i :class="hidden ? 'fa-plus' : 'fa-minus'" class="fa-solid"></i>
        </div>
        <ul :class="{hidden, 'flex-col': info.col, 'gap-x-0': !info.col}" class="mt-6 flex flex-wrap gap-4">
            <li v-for="(field, i) in fields" :key="i" :class="{'w-1/2': !info.col, 'lg:w-1/4': !info.col}" class="flex gap-3">
                <input :type="info.type" :name="info.name" :id="field.id">
				<label class="w-full" :for="field.id">{{ field.label }}</label>
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
            fields: this.info.filters,
            hidden: true,
        }
    },
    methods: {
        toggleFilters() {
            return this.hidden = !this.hidden
        }
    }
}
</script>

<style lang="scss" scoped>

</style>