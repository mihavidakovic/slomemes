<template>
	<div>
		<div class="loading" v-show="loading">
			<div class="waves"></div>
		</div>
		<div v-if="this.memes.length > 0">
			<ul class="posts-grid">
				<meme v-for="meme in memes" :meme="meme" :key="meme.id"></meme>
			</ul>
			<pagination :meta="meta" v-on:pagination:switched="getNalozene"></pagination>
		</div>
		<div v-else="">
			<p class="empty">Prazno :(</p>
		</div>
	</div>
</template>

<script>
	import Meme from './partials/Meme.vue'
	import Pagination from '../pagination/Pagination.vue'

	export default {
		components: {
			Meme, Pagination
		},
		name: "Nalozeno",
		data () {
			return {
				loading: true,
				memes: [],
				meta: {},
			}
		},
		props: ['username'],
		created () {
			this.getNalozene()
		},
		methods: {
			getNalozene(page) {
				var url = '/api/uporabnik/' + this.username + '/nalozeno'
				axios.get(url, {
					params: {
						page
					}
				}).then((response) => {
					this.memes = response.data.data
					this.meta = response.data.meta
					this.loading = false
				})
			}
		}
	}
</script>