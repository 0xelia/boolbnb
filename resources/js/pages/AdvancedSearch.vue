<template>
	<main>
		<div class="container py-8 text-center">
			<div class="text-sm mb-2">Risultati di ricerca per</div>
			<SearchBox class="mx-auto" />
		</div>
		<div class="container flex flex-col lg:flex-row lg:gap-8">
			<div class="lg:w-1/4">filtri</div>
			<div class="lg:flex-grow">cards</div>
		</div>
	</main>
</template>

<script>
import SearchBox from '../components/SearchBox.vue'

export default {
	components: {
		SearchBox,
	}
}
</script>

<style lang="scss" scoped>
.search-box {
	max-width: 650px;
}
</style>