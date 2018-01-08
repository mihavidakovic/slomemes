<template>
	<li>
		<a :href="'/meme/' + meme.id">
			<div class="preview" :style="{ backgroundImage: 'url(' + meme.url + ')' }">
				<div class="info">
					<p>{{meme.naslov}}</p>
					<span class="lajki"><i class="ion-thumbsup"></i> {{meme.upvoti_count - meme.downvoti_count}}</span>
					<span class="komentarji"><i class="ion-ios-chatbubble"></i> {{meme.komentarji_count}}</span>
				</div>
			</div>
		</a>
	</li>
</template>

<script>
	export default {
		props: ['meme']
	}
</script>