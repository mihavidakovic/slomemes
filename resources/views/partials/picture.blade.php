<div class="col-lg-8 col-md-8 col-sm-8 picture-wrap">
    <div class="title">
      <div class="votes">
          <span><i class="ion-thumbsup"></i> <span class="glasovi">0</span></span>
      </div>
        <h2 class="naslov"><span></span></h2>
      <div class="hide-comments" data-toggle="tooltip" data-placement="left"  title="Skrij komentarje"><i class="ion ion-eye-disabled"></i></div>
    </div>
    <div class="picture" data-id="">
      <div class="loading">
          <div class="waves"></div>
      </div>
      <div class="bottom-bar">
        <div class="infos">
          <ul class="quick-info">
            <li>
              <p><i class="ion ion-person"></i> <span class="username">xy</span> </p>
            </li>
            <li>
              <p><i class="ion ion-android-time"></i> <span class="ustvarjeno"></span></p>
            </li>
          </ul>
        </div>
        <ul class="sharing">
          <li class="facebook">
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://slomemes.si/meme/1">
              <div class="inside">
                <i class="ion ion-social-facebook"></i>
                <p>Deli na Facebook-u</p>
              </div>
            </a>
          </li>
          <li class="messenger">
            <a href="#">
              <div class="inside">
                <img src="{{asset('img/messenger.svg')}}">
                <p>Pošlji kot sporočilo</p>
              </div>
            </a>
          </li>
        </ul>
      </div>  
        <div class="show-picture slika">
        </div>
         <!--  <div class="empty">
            <h3>:(</h3>
            <h4>Trenutno ni na voljo noben meme</h4>
          </div> -->
        <a href="#">
          <div class="control dislike">
              <i class="ion ion-thumbsdown"></i>
          </div>
        </a>
        <a href="#">
          <div class="control like">
              <i class="ion ion-thumbsup"></i>
          </div>
        </a>
    </div>
    <div style="clear: both;"></div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 comments-wrap">
  @include('partials.comments')
</div>
