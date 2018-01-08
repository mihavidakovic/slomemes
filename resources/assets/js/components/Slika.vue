<template>
    <div class="main box col-lg-12">
        <div class="col-lg-8 col-md-8 col-sm-8 picture-wrap">
            <div class="title">
              <div class="votes">
                  <span><i class="ion-thumbsup"></i> <span class="glasovi">{{this.id ? (this.slike.upvoti_count - this.slike.downvoti_count) : (this.slike[trenutnaSlika].upvoti_count - this.slike[trenutnaSlika].downvoti_count)}}</span></span>
              </div>
                <h2 class="naslov">{{this.id ? this.slike.naslov : this.slike[trenutnaSlika].naslov}}</h2>
              <div class="hide-comments" data-toggle="tooltip" data-placement="left"  title="Skrij komentarje"><i class="ion ion-eye-disabled"></i></div>
            </div>
            <div class="picture" data-id="">
              <div class="loading" v-show="loading">
                  <div class="waves"></div>
              </div>
              <div class="bottom-bar">
                <div class="infos">
                  <ul class="quick-info">
                    <li>
                      <p><i class="ion ion-person"></i> <span class="username">{{this.id ? "mh" : this.slike[trenutnaSlika].user.name}}</span> </p>
                    </li>
                    <li>
                      <p></p>
                    </li>
                  </ul>
                </div>
                <ul class="sharing">
                  <li class="facebook">
                    <a target="_blank" :href="'https://www.facebook.com/sharer/sharer.php?u=http://slomemes.si/meme/' + (this.id ? this.slike.id :  this.slike[trenutnaSlika].id)">
                      <div class="inside">
                        <i class="ion ion-social-facebook"></i>
                        <p>Deli na Facebook-u</p>
                      </div>
                    </a>
                  </li>
                  <li class="messenger">
                    <a href="#">
                      <div class="inside">
                        <img src="">
                        <p>Pošlji kot sporočilo</p>
                      </div>
                    </a>
                  </li>
                </ul>
              </div>  
                <div class="show-picture slika" :style="{'background-image': 'url(' + (this.id ? this.slike.url : this.slike[trenutnaSlika].url) + ')'}">
                </div>
                 <!--  <div class="empty">
                    <h3>:(</h3>
                    <h4>Trenutno ni na voljo noben meme</h4>
                  </div> -->
                <a href="#">
                  <div class="control dislike" @click="this.id ? downvote(slike.id) : downvote(slike[trenutnaSlika].id)">
                      <i class="ion ion-thumbsdown"></i>
                  </div>
                </a>
                <a href="#">
                  <div class="control like" @click="this.id ? upvote(slike.id) : upvote(slike[trenutnaSlika].id)">
                      <i class="ion ion-thumbsup"></i>
                  </div>
                </a>
            </div>
            <div style="clear: both;"></div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 comments-wrap">
            <komentarji :id="this.id ? this.slike.id : this.slike[0].id" />
        </div>
    </div>

</template>

<script>
    export default {
        data: function() {
            return {
                slike: [],
                trenutnaSlika: 0,
                loading: true,
            }
        },
        props: ['id'],
        methods: {
            getSlike: function() {
                var self = this;
                self.loading = true;
                if (!this.id) {
                  axios.get('/api/slike')
                    .then(function (response) {
                      self.slike = response.data.slike;
                      self.trenutnaSlika = 0;
                      self.loading = false;

                    })
                    .catch(function (error) {
                      console.log(error);
                    });
                } else {
                  axios.get('/api/slika/' + this.id)
                    .then(function (response) {
                      self.slike = response.data.slike;
                      self.trenutnaSlika = 0;
                      self.loading = false;
                      console.log(response.data.slike)

                    })
                    .catch(function (error) {
                      console.log(error);
                    });
                }
            },
            upvote: function(id) {
                var self = this;
                self.loading = true;
                self.komentarji = [];
                var currentID = id + 1;
                if (self.slike.length == 1) {
                    axios.get('/api/slike/24/0')
                      .then(function (response) {
                        self.slike = response.data.slike;
                        self.trenutnaSlika = 0;
                        self.loading = false;
                        // self.fetchComments(self.slike[self.trenutnaSlika].id);
                      })
                      .catch(function (error) {
                        console.log(error);
                    });
                } else {
                    self.loading = false;
                    Vue.delete(self.slike, self.trenutnaSlika);
                }
                axios.get('/api/vote/' + id)
                  .then(function (response) {

                  })
                  .catch(function (error) {
                    console.log(error);
                });
            },
            downvote: function(id) {
                var self = this;
                self.loading = true;
                self.komentarji = [];
                var currentID = id + 1;
                if (self.slike.length == 1) {
                    axios.get('/api/slike/24/0')
                      .then(function (response) {
                        self.slike = response.data.slike;
                        self.trenutnaSlika = 0;
                        self.loading = false;
                        // self.fetchComments(self.slike[self.trenutnaSlika].id);
                      })
                      .catch(function (error) {
                        console.log(error);
                    });
                } else {
                    self.loading = false;
                    Vue.delete(self.slike, self.trenutnaSlika);
                }
                axios.get('/api/downvote/' + id)
                  .then(function (response) {

                  })
                  .catch(function (error) {
                    console.log(error);
                });
            },

        },
        beforeMount() {
            this.getSlike();
        }
    }
</script>
