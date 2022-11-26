<template>
	<main>
		<div class="container py-8 text-center">
			<div class="text-sm mb-2">Risultati di ricerca per</div>
			<SearchBox class="mx-auto" />
		</div>
		<div class="container flex flex-col lg:flex-row lg:gap-8">
			<div class="lg:w-1/4">
				<AccordionFilter v-for="(category, i) in categories" :key="i" :info="category" />
			</div>
			<div class="lg:flex-grow">cards</div>
		</div>
	</main>
</template>

<script>
import SearchBox from '../components/SearchBox.vue'
import AccordionFilter from '../components/AccordionFilter.vue'

export default {
	data() {
		return {
			categories: [
				{
					title: 'Stanze',
					type: 'radio',
					name: 'rooms',
					filters: [
						{
							label: '1',
							id: 'room-1'
						},
						{
							label: '2',
							id: 'room-2'
						},
						{
							label: '3',
							id: 'room-3'
						},
					],
				},
				{
					title: 'Letti',
					type: 'radio',
					name: 'beds',
					filters: [
						{
							label: '1',
							id: 'bed-1'
						},
						{
							label: '2',
							id: 'bed-2'
						},
						{
							label: '3',
							id: 'bed-3'
						},
					],
				},
				{
					title: 'Bagni',
					type: 'radio',
					name: 'baths',
					filters: [
						{
							label: '1',
							id: 'bath-1'
						},
						{
							label: '2',
							id: 'bath-2'
						},
						{
							label: '3',
							id: 'bath-3'
						},
					],
				},
				{
					title: 'Distanza',
					type: 'radio',
					name: 'meters',
					filters: [
						{
							label: '5 km',
							id: 'meter-1'
						},
						{
							label: '10 km',
							id: 'meter-2'
						},
						{
							label: '20km',
							id: 'meter-3'
						},
					],
				},
				{
					title: 'Servizi',
					type: 'checkbox',
					name: 'services',
					filters: [
						{
							label: 'WiFi',
							id: 'wifi-1'
						},
						{
							label: 'Piscina',
							id: 'wifi-2'
						},
						{
							label: 'Parcheggio macchina',
							id: 'wifi-3'
						},
					],
				},
			]
		}
	},
	components: {
		SearchBox,
		AccordionFilter,
	}
}
</script>

<style lang="scss" scoped>
.search-box {
	max-width: 650px;
}
</style>