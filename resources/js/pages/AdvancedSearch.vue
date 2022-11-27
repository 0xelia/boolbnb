<template>
	<main @send-value="getInputValue">
		<!-- hero -->
		<div class="container py-8 text-center">
			<div class="text-sm mb-2">Risultati di ricerca per</div>
			<SearchBox class="mx-auto" />
		</div>

		<!-- header filters -->
		<div class="container">
			<div class="flex flex-wrap items-center mb-4 gap-6 lg:w-3/4 lg:pl-4 lg:ml-auto">
				<div class="font-bold">{{ apartments.length }} Appartamenti</div>
				
				<select class="ml-auto">
					<option data="">Ordina per</option>
					<option value="">Rilevanza</option>
					<option value="">Data di aggiunta</option>
					<option value="">Distanza</option>
				</select>
				
				<div @click="toggleFilters" class="lg:hidden">
					<i class="fa-solid fa-filter"></i>
				</div>

				<div :class="{hidden}" class="w-full mb-8 lg:hidden text-sm">
					<AccordionFilter :class="i === new_categories.length -1 ? 'border-b' : ''" v-for="(category, i) in new_categories" :key="i" :info="category" />
				</div>
			</div>
		</div>

		<!-- filters & cards -->
		<div class="container lg:flex lg:items-start lg:gap-6">
			<div class="hidden lg:block lg:w-1/4 text-sm">
				<AccordionFilter :class="i === new_categories.length -1 ? 'border-b' : ''" v-for="(category, i) in new_categories" :key="i" :info="category" />
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
const room_filters = [
	{
		label: '1',
		id: 'room-1',
		value: 1,
	},
	{
		label: '2',
		id: 'room-2',
		value: 2,
	},
	{
		label: '3',
		id: 'room-3',
		value: 3,
	},
	{
		label: '4+',
		id: 'room-4',
		value: 4,
	},
]
const bed_filters = [
	{
		label: '1',
		id: 'beds-1',
		value: 1,
	},
	{
		label: '2',
		id: 'beds-2',
		value: 2,
	},	
	{
		label: '3',
		id: 'beds-3',
		value: 3,
	},
	{
		label: '4+',
		id: 'beds-4',
		value: 4,
	},	
]
const distance_filters = [
	{
		label: '5 km',
		id: 'distance-1',
		value: 1,
	},
	{
		label: '10 km',
		id: 'distance-2',
		value: 2,
	},	
	{
		label: '20 km',
		id: 'distance-3',
		value: 3,
	},
	{
		label: '50 km',
		id: 'distance-4',
		value: 4,
	},
]
export default {
	data() {
		return {

			room_filters,
			bed_filters,
			distance_filters,

			new_categories: [],

			hidden: true,
			apartments: [],
			service_list: [],
			// categories: [
			// 	{
			// 		title: 'Stanze',
			// 		type: 'radio',
			// 		name: 'rooms',
			// 		col: false,
			// 		filters: [
			// 			{
			// 				label: '1',
			// 				id: 'room-1'
			// 			},
			// 			{
			// 				label: '2',
			// 				id: 'room-2'
			// 			},
			// 			{
			// 				label: '3',
			// 				id: 'room-3'
			// 			},
			// 			{
			// 				label: '4',
			// 				id: 'room-4'
			// 			},
			// 			{
			// 				label: '5',
			// 				id: 'room-5'
			// 			},
			// 			{
			// 				label: '6',
			// 				id: 'room-6'
			// 			},
			// 			{
			// 				label: '7',
			// 				id: 'room-7'
			// 			},
			// 			{
			// 				label: '8+',
			// 				id: 'room-8'
			// 			},
			// 		],
			// 	},
			// 	{
			// 		title: 'Letti',
			// 		type: 'radio',
			// 		name: 'beds',
			// 		col: false,
			// 		filters: [
			// 			{
			// 				label: '1',
			// 				id: 'bed-1'
			// 			},
			// 			{
			// 				label: '2',
			// 				id: 'bed-2'
			// 			},
			// 			{
			// 				label: '3',
			// 				id: 'bed-3'
			// 			},
			// 			{
			// 				label: '4',
			// 				id: 'bed-4'
			// 			},
			// 			{
			// 				label: '5',
			// 				id: 'bed-5'
			// 			},
			// 			{
			// 				label: '6',
			// 				id: 'bed-6'
			// 			},
			// 			{
			// 				label: '7',
			// 				id: 'bed-7'
			// 			},
			// 			{
			// 				label: '8',
			// 				id: 'bed-8+'
			// 			},
			// 		],
			// 	},
			// 	{
			// 		title: 'Bagni',
			// 		type: 'radio',
			// 		name: 'baths',
			// 		col: false,
			// 		filters: [
			// 			{
			// 				label: '1',
			// 				id: 'bath-1'
			// 			},
			// 			{
			// 				label: '2',
			// 				id: 'bath-2'
			// 			},
			// 			{
			// 				label: '3',
			// 				id: 'bath-3'
			// 			},
			// 		],
			// 	},
			// 	{
			// 		title: 'Distanza',
			// 		type: 'radio',
			// 		name: 'meters',
			// 		col: false,
			// 		filters: [
			// 			{
			// 				label: '5 km',
			// 				id: 'meter-1'
			// 			},
			// 			{
			// 				label: '10 km',
			// 				id: 'meter-2'
			// 			},
			// 			{
			// 				label: '20km',
			// 				id: 'meter-3'
			// 			},
			// 		],
			// 	},
			// 	{
			// 		title: 'Servizi',
			// 		type: 'checkbox',
			// 		name: 'services',
			// 		col: true,
			// 		filters: [
			// 			{
			// 				label: 'WiFi',
			// 				id: 'wifi-1'
			// 			},
			// 			{
			// 				label: 'Piscina',
			// 				id: 'wifi-2'
			// 			},
			// 			{
			// 				label: 'Parcheggio macchina',
			// 				id: 'wifi-3'
			// 			},
			// 		],
			// 	},
			// ]
		}
	},
	components: {
		SearchBox,
		AccordionFilter,
		ApartmentCard,
	},
	methods: {
		getInputValue(d) {
			console.log(d);
		},
		fetchApartments() {
			axios.get('api/apartments/index/all').then(res => {
				const { apartments, service_list } = res.data
				this.apartments = apartments
				this.service_list = service_list
				// console.log(apartments);
				// console.log(service_list);
			})
		},
		toggleFilters() {
			return this.hidden = !this.hidden
		},
		get_new_categories() {
			const categories = []

			const rooms = this.setCategory('Stanze', 'rooms_number', this.room_filters)
			categories.push(rooms)

			const beds = this.setCategory('Letti', 'beds_number', this.bed_filters)
			categories.push(beds)
			
			const distances = this.setCategory('Distanza', 'distance', this.distance_filters)
			categories.push(distances)

			console.log(categories);
			return this.new_categories = categories
		},
		setCategory(title, name, filters, type = 'radio') {
			return {
				title,
				name,
				type,
				filters
			}
		}
	},
	created() {
		this.fetchApartments()
		this.get_new_categories()
	}
}
</script>

<style lang="scss" scoped>
.search-box {
	max-width: 650px;
}
</style>