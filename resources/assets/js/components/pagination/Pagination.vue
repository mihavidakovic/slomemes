<template>
	<nav>
		<ul class="pagination">
			<li :class="{'disabled' : meta.current_page === 1}">
				<a href="#" @click.prevent="switched(meta.current_page - 1)">&laquo;</a>
			</li>
			<template v-if="section > 1">
				<li>
					<a href="#" @click.prevent="switched(1)">1</a>
				</li>
				<li>
					<a href="#" @click.prevent=goBackASection>...</a>
				</li>
			</template>
			<li v-for="page in pages" :class="{'active' : meta.current_page === page}">
				<a href="#" @click.prevent="switched(page)">{{page}}</a>
			</li>
			<template v-if="section < sections">
				<li>
					<a href="#" @click.prevent=goForwardASection>...</a>
				</li>
				<li>
					<a href="#" @click.prevent="switched(meta.last_page)">{{meta.last_page}}</a>
				</li>
			</template>
			<li :class="{'disabled' : meta.current_page === meta.last_page}">
				<a href="#" @click.prevent="switched(meta.current_page + 1)">&raquo;</a>
			</li>
		</ul>
	</nav>
</template>

<script>
	export default {
		props: ['meta'],

		data () {
			return {
				numbersPerSection: 7
			}
		},

		computed: {
			section () {
				return Math.ceil(this.meta.current_page / this.numbersPerSection)
			},

			sections () {
				return Math.ceil(this.meta.last_page / this.numbersPerSection)
			},

			lastPage () {
				let lastPage = ((this.section - 1) * this.numbersPerSection) + this.numbersPerSection

				if (this.section === this.sections) {
					lastPage = this.meta.last_page
				}

				return lastPage
			},

			pages () {
				return _.range((this.section - 1) * this.numbersPerSection + 1, 
					this.lastPage + 1
				)
			}

		},
		methods: {
			switched (page) {
				if (page <= 0 || page > this.meta.last_page) {
					return 
				}
				this.$emit('pagination:switched', page)
			},

			goBackASection() {
				this.switched(
					this.firstPageOfSection(this.section - 1)
				)
			},

			goForwardASection() {
				this.switched(
					this.firstPageOfSection(this.section + 1)
				)
			},

			firstPageOfSection(section) {
				return (section - 1) * this.numbersPerSection + 1
			}
		}
	}
</script>