<template>
	<main>
		<!-- hero -->
		<div class="container py-8 text-center">
			<div class="text-sm mb-2">Risultati di ricerca per</div>
			<SearchBox class="mx-auto" />
		</div>

		<!-- header filters -->
		<div class="container">
			<div class="flex flex-wrap items-center mb-4 gap-6 lg:w-3/4 lg:pl-4 lg:ml-auto">
				<div class="font-bold">{{ apartments.length }} Appartamenti</div>

				<div>
					<span v-for="(filter, i) in filters" :key="filter[i]">{{ filter[0] }}</span>
				</div>

				<select class="ml-auto">
					<option data="">Ordina per</option>
					<option value="">Rilevanza</option>
					<option value="">Data di aggiunta</option>
					<option value="">Distanza</option>
				</select>
				
				<div @click="toggleFilters" class="lg:hidden">
					<i class="fa-solid fa-filter"></i>
				</div>

				<div v-if="show & screen < 1024" class="w-full mb-8 text-sm">
					<AccordionFilter @filter="onFilter" :class="i === categories.length -1 ? 'border-b' : ''" v-for="(category, i) in categories" :key="i" :info="category" />
				</div>
			</div>
		</div>

		<!-- filters & cards -->
		<div class="container lg:flex lg:items-start lg:gap-6">
			<div v-if="screen >= 1024" class="block lg:w-1/4 text-sm">
				<AccordionFilter @filter="onFilter" :class="i === categories.length -1 ? 'border-b' : ''" v-for="(category, i) in categories" :key="i" :info="category" />
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

const categories = [
	{
		title: 'Stanze',
		type: 'radio',
		name: 'rooms_number',
		filters: [
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
	},
	{
		title: 'Letti',
		type: 'radio',
		name: 'beds_number',
		filters: [
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
	},	
	{
		title: 'Distanza',
		type: 'radio',
		name: 'distance',
		filters: [
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
	},
	{
		title: 'Servizi',
		type: 'checkbox',
		name: 'services',
		filters: [
			{
				label: 'WiFi',
				id: 'wifi',
				value: 'WiFi',
			},
			{
				label: 'Posto Macchina',
				id: 'posto-macchina',
				value: 'Posto Macchina',
			},	
			{
				label: 'Piscina',
				id: 'piscina',
				value: 'Piscina',
			},
			{
				label: 'Portineria',
				id: 'portineria',
				value: 'Portineria',
			},
			{
				label: 'Sauna',
				id: 'sauna',
				value: 'Sauna',
			},
			{
				label: 'Vista Mare',
				id: 'vista-mare',
				value: 'Vista Mare',
			},	
		]
	},	
]

export default {
	data() {
		return {
			show: false,
			screen: window.innerWidth,
			apartments: [],
			categories,
			filters: [],
		}
	},
	components: {
		SearchBox,
		AccordionFilter,
		ApartmentCard,
	},
	computed: {
		filtered_apartments() {
			const [name, value] = this.filters

			return this.apartments.filter(apartment => {
				if (name === 'rooms_number' && value === 4 || name === 'beds_number' && value === 4) {
					return apartment[name] >= value
				}
				return apartment[name] === value
			})
		},
	},
	methods: {
		onFilter(data) {
			const [ name, value ] = data
			if (!this.filters.includes(name)) {
				this.filters.push([name, value])
			}
			console.log(this.filters);
		},
		fetchApartments() {
			axios.get('api/apartments/index/all').then(res => {
				const { apartments } = res.data
				this.apartments = apartments
			})
		},
		toggleFilters() {
			return this.show = !this.show
		},
	},
	created() {
		this.fetchApartments()
	},
	mounted() {
		window.addEventListener('resize', () => {
			this.screen = window.innerWidth
		})
	}
}
</script>

<style lang="scss" scoped>
.search-box {
	max-width: 650px;
}
</style>