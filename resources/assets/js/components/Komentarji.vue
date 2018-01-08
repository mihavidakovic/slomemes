<template>
    <div>
        <div class="comments-header" @click="toggleCommentsState()">
          <h3>Komentarji (<span class="num-comments">{{this.num}}</span>)</h3>
          <div class="hide-comments" data-toggle="tooltip" data-placement="left"  title="Skrij komentarje"><i class="ion ion-eye"></i></div>
        </div>
        <ul class="comments" id="comments">
            <div class="loading" v-show="loading">
                <div class="waves"></div>
            </div>
            <span v-if="komentarji.length == 0">
                <p class="no-comments">Trenutno še ni komentarjev</p>
            </span>
            <li class="comment" v-for="komentar in komentarji">
                <div class="top"> 
                    <p>
                        <a target="_blank" :href="'uporabnik/' + komentar.user.name">{{komentar.user.name}}</a> 
                    <small :title="komentar.created_at">
                        {{komentar.created_at | moment("from", "now")}}<span> | <a href="#">Uredi</a> | <a href="#">Izbriši</a></span>
                    </small>
                    </p>
                </div> 
                <div class="content"> 
                    <p>{{komentar.content}}</p>
                </div>
            </li>
        </ul>
         <div class="add-comment">
            <textarea v-model="newMessage" placeholder="Tukaj komentiraj meme"></textarea>
             <button @click="addComment(id)" class="btn btn-default"><i class="ion ion-android-send"></i></button>
         </div> 
    </div>
</template>

<script>
    import EventBus from './event-bus';
    export default {
        data: function() {
            return {
                newMessage: "",
                loading: false,
                komentarji: [],
                num: 0,
                commentsState: true,
                userInfoPopup: false,
                userInfo: [],
            }
        },
        props: ['id'],
        methods: {
            addComment: function(id) {
                var self = this;
                var komentarjiDiv = document.getElementById("comments");
                var api = "/comment/" + id + "/add";
                self.loading = true;
                axios.post(api, {
                    id: id,
                    content: self.newMessage,
                })
                .then(function (response) {
                    self.komentarji.push({
                        user: response.data.user, 
                        content: response.data.komentar.content,
                        created_at: response.data.komentar.created_at,
                        id: response.data.komentar.id,
                        post_id: id,
                    });
                    self.loading = false;
                    self.num = self.num + 1;
                    self.newMessage = "";
                    setTimeout(function() {
                        komentarjiDiv.scrollTop = komentarjiDiv.scrollHeight;
                    }, 10);
                }).catch(function (error) {
                    self.loading = false;
                    console.log(error);
                });
            },
            fetchComments: function(id) {
                var self = this;
                self.loading = true;
                axios.get('/komentarji/' + id)
                .then(function (response) {
                    self.komentarji = response.data.komentarji;
                    self.num = response.data.num;
                    self.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            toggleCommentsState: function() {
                var self = this;
                if (self.commentsState === true) {
                    self.commentsState = false;
                } else {
                    self.commentsState = true;
                }
                console.log('lol');
            }
        },
        watch: {
            id: function(noviKomentarji) {
                if (this.id) {
                    this.fetchComments(this.id);
                    console.log(this.id);
                }
            }
        },
        mounted() {
            this.fetchComments(this.id);
        }
    }
</script>
