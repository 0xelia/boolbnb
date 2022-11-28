<template>
	<main v-if="apartments">
		<!-- hero -->
		<div class="container py-8 text-center">
			<div class="text-sm mb-2">Risultati di ricerca per</div>
			<SearchBox class="mx-auto" />
		</div>

		<!-- header filters -->
		<div class="container">
			<div class="flex flex-wrap items-center mb-4 gap-6 lg:w-3/4 lg:pl-4 lg:ml-auto">
				<div class="font-bold">{{ apartments.length }} Appartamenti</div>

				<!-- <div>
					<span v-for="(filter, i) in filters" :key="filter[i]">{{ filter[0] }}</span>
				</div> -->

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
				<ApartmentCard v-for="(info, i) in filtered_apartments" :key="i" :apartment="info" />
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
				value: 5,
			},
			{
				label: '10 km',
				id: 'distance-2',
				value: 10,
			},	
			{
				label: '20 km',
				id: 'distance-3',
				value: 20,
			},
			{
				label: '50 km',
				id: 'distance-4',
				value: 50,
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
			filters: {
				rooms_number: 2,
				beds_number: 2,
				distance: 20,
				services: [],
			},
		}
	},
	components: {
		SearchBox,
		AccordionFilter,
		ApartmentCard,
	},
	computed: {
		filtered_apartments() {
			return this.apartments.filter(apartment => {
				for (const key in this.filters) {
					console.log(key + ': ' + this.filters[key])
					if ( key.endsWith('_number') ) {
						if (this.filters[key] < 4) {
							return apartment[key] = this.filters[key]
						} else {
							return apartment[key] >= this.filters[key]
						}
					}
				}
				// this.filters.forEach((value, key) => {
				// 	if (key !== 'services') {
				// 		if (key !== 'distance') {
				// 			if (value < 4) {
				// 				return apartment[key] = value
				// 			} else {
				// 				return apartment[key] >= value
				// 			}
				// 		} else {
				// 				return apartment[key] = value
				// 		}
				// 	} else {
				// 	}
				// 	return apartment[key] === value
				// })
			})
		},
	},
	methods: {
		onFilter(data) {			
			const [ name, value ] = data
			if (name === 'services') {
				if (!this.filters.services.includes(value)) {
					this.filters['services'].push(value)
				} else {
					const index = this.filters['services'].indexOf(value)
					this.filters['services'].splice(index, 1)
				}
			} else {
				this.filters[name] = value
			}
		},
		fetchApartments() {
			axios.get('api/apartments/index/all').then(res => {
				const { apartments } = res.data
				this.apartments = apartments
				console.log(this.apartments);
			})
		},
		toggleFilters() {
			return this.show = !this.show
		},
		getDistanceFromLatLonInKm(lat1, lon1, lat2, lon2) {
			var R = 6371; // Radius of the earth in km
			var dLat = deg2rad(lat2-lat1);  // deg2rad below
			var dLon = deg2rad(lon2-lon1); 
			var a = 
				Math.sin(dLat/2) * Math.sin(dLat/2) +
				Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
				Math.sin(dLon/2) * Math.sin(dLon/2)
				; 
			var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
			var d = R * c; // Distance in km
			return d;
		},
		deg2rad(deg) {
			return deg * (Math.PI/180)
		}
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