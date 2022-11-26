<template>
	<main>
		<div class="container py-8 text-center">
			<div class="text-sm mb-2">Risultati di ricerca per</div>
			<SearchBox class="mx-auto" />
		</div>
		<div class="container lg:flex lg:items-start lg:gap-6">
			<div class="text-sm mb-8 lg:w-1/4">
				<AccordionFilter :class="i === categories.length -1 ? 'border-b' : ''" v-for="(category, i) in categories" :key="i" :info="category" />
			</div>
			<div class="lg:w-3/4 grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-10 xl:grid-cols-3">
				<ApartmentCard v-for="(info, i) in apartments" :key="i" :apartment="info" />
			</div>
		</div>
	</main>
</template>

<script>
import SearchBox from '../components/SearchBox.vue'
import AccordionFilter from '../components/AccordionFilter.vue'
import ApartmentCard from '../components/ApartmentCardComponent.vue'

export default {
	data() {
		return {
			apartments: [],
			categories: [
				{
					title: 'Stanze',
					type: 'radio',
					name: 'rooms',
					col: false,
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
						{
							label: '4',
							id: 'room-4'
						},
						{
							label: '5',
							id: 'room-5'
						},
						{
							label: '6',
							id: 'room-6'
						},
						{
							label: '7',
							id: 'room-7'
						},
						{
							label: '8+',
							id: 'room-8'
						},
					],
				},
				{
					title: 'Letti',
					type: 'radio',
					name: 'beds',
					col: false,
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
						{
							label: '4',
							id: 'bed-4'
						},
						{
							label: '5',
							id: 'bed-5'
						},
						{
							label: '6',
							id: 'bed-6'
						},
						{
							label: '7',
							id: 'bed-7'
						},
						{
							label: '8',
							id: 'bed-8+'
						},
					],
				},
				{
					title: 'Bagni',
					type: 'radio',
					name: 'baths',
					col: false,
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
					col: false,
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
					col: true,
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
		ApartmentCard,
	},
	methods: {
		fetchApartments() {
			axios.get('api/apartments/index/sponsored').then(res => {
				const { apartments } = res.data
				this.apartments = apartments
				console.log(apartments);
			})
		},
	},
	created() {
		this.fetchApartments()
	}
}
</script>

<style lang="scss" scoped>
.search-box {
	max-width: 650px;
}
</style>