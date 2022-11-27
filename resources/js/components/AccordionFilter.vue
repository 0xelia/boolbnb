<template>
    <div class="accordion py-6 border-t border-gray-300">
        <div @click="toggleFilters" class="py-6 -my-6 flex justify-between gap-4">
            <h3 class="text-gray-700">{{ info.title }}</h3>
            <i :class="hidden ? 'fa-plus' : 'fa-minus'" class="fa-solid"></i>
        </div>
        <ul :class="{hidden}" class="mt-6 flex flex-col gap-4">
            <li v-for="(filter, i) in info.filters" :key="i" class="flex gap-3">
                <input @change="$emit('send-value', selected)" v-model="selected" :value="filter.value" :type="info.type" :name="info.name" :id="filter.id">
				<label class="w-full" :for="filter.id">{{ filter.label }}</label>
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
            // fields: this.info.filters,
            hidden: true,
            selected: '',
        }
    },
    computed: {
        names() {

        }
    },
    methods: {
        toggleFilters() {
            return this.hidden = !this.hidden
        }
    },
    mounted() {
        console.log(this.info);
    }
}
</script>

<style lang="scss" scoped>

</style>