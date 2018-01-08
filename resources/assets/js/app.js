
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
window.Vue = require('vue');

import VueRouter from 'vue-router'
Vue.use(VueRouter)

require('./bootstrap');

require('../../../node_modules/axios');


const moment = require('moment')
require('moment/locale/sl')
Vue.use(require('vue-moment'), {
    moment
})


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('slika', require('./components/Slika.vue'));
Vue.component('komentarji', require('./components/Komentarji.vue'));
Vue.component('profile', require('./components/user/Profile.vue'));

const app = new Vue({
    el: '#app',
    data: {
    	user: []
    },
    mounted() {
    	this.fetchUserApi()
    },
	methods: {
		fetchCurrentUser () {
			EventBus.$emit('fetchUser');
		},
        fetchUserApi() {
	    	var self = this;
	      	axios.get('/api/uporabnik')
	        .then(function (response) {
	        	self.user = response.data
	        })
	        .catch(function (error) {
	          console.log(error);
	        });
		}
	}
});
