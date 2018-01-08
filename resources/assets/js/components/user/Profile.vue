<template>
	<div class="inside box">
	  <div class="content">
	    <div :class="editMode ? 'top editMode' : 'top'">
	      <div class="header" :style="{ backgroundImage: 'url(' + user.cover + ')' }">
			<span class="header1">
				<span v-if="editMode" class="header2">
					<div class="change-header">
						<p><i class="ion-camera"></i><br>Spremeni ozadje</p>
					</div>
				</span>
				<span v-else="">
				</span>
			</span>
	        <div class="center">
	          <span>
	          	<span v-if="editMode">
	          		<div class="user-photo" :style="{ backgroundImage: 'url(' + this.user.avatar + ')' }">
	          			<div class="change-photo">
	          				<label for="avatar">
	          					<p><i class="ion-image"></i><br>Spremeni profilko</p>
	          				</label>
	          				<input type="file" name="avatar" ref="avatar" @change="updateProfilka" id="avatar">
	          			</div>
	          		</div>
	          	</span>
	          	<span v-else="">
	          		<div class="user-photo" :style="{ backgroundImage: 'url(' + this.user.avatar + ')' }">
	          		</div>
	          	</span>
	          	<h3>{{this.user.name}} <i v-if="this.user.verified === 1" class="ion ion-checkmark-circled verified" title="Potrjen"></i></h3>
	          </span>
	          <p class="status">{{this.user.rank}}</p>
	        </div>
	        <ul class="meni">
	          <li class="active">
	            <a href="#">Moji memeji <span>({{this.user.slike_count}})</span></a>
	          </li>
	          <li>
	            <a href="#">Všeč mi je</a>
	          </li>
	          <li>
	            <a href="#">Ni mi všeč</a>
	          </li>
	          <li class="edit-profile-button" v-if="editMode">
	          	<a href="#"><i class="ion-checkmark"></i> Shrani spremembe</a>
	          </li>
	          <li class="edit-profile-button" v-else="" @click.prevent="editMode = !editMode">
	          	<a href="#"><i class="ion-edit"></i> Uredi profil</a>
	          </li>
	          <li class="save-profile-button"  v-if="editMode" @click.prevent="editMode = !editMode">
	          	<a href="#"><i class="ion-android-close"></i> Zavrzi</a>
	          </li>
	        </ul>
	      </div>
	    </div>
	    <div class="profil-content">
	      <Nalozeno :username="this.username"></Nalozeno>
	    </div>
	  </div>
	</div>
</template>

<script>
	import Nalozeno from './Nalozeno.vue'

	export default {
		components: {
			Nalozeno
		},
		name: "Profile",
		data () {
			return {
				user: [],
				editMode: false,
				newAvatar: null,

			}
		},
		props: ['username'],
		mounted () {
			this.getUser(this.username)
		},
		methods: {
			getUser(username) {
				var self = this;
				var url = '/api/uporabnik/' + username;
				axios.get(url).then((response) => {
					self.user = response.data
				})
			},
			updateProfilka(e) {
				var self = this;
				self.newAvatar = e.dataTransfer.files
				axios.post('/profil/uredi/profilka', {
					newAvatar: e.dataTransfer.files
				}).then((response) => {
					console.log(response.data)
				})
			}
		}
	}
</script>