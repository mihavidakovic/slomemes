@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row subpage ustvari">
      <div class="col-lg-8 col-md-8 col-sm-8" style="margin-bottom: 20px; float: left;">
        <div class="inside box">
          <header>
            <p class="meme-generator-title">Izberi meme</p>
          </header>
          <div class="content">
            <div class="meme-generator">
              <div class="step step-1 current">
                <ul class="select">
                  <li data-id="1" data-src="http://i.memeful.com/media/post/rw9BrMv_700w_0.jpg" class="meme-initial">
                    <div class="info">
                      <p>Scumbag Steve</p>
                    </div>
                    <img src="http://i.memeful.com/media/post/rw9BrMv_700w_0.jpg">
                  </li>
                  <li data-id="2" data-src="https://i.imgflip.com/i9eg5.jpg" class="meme-initial">
                    <div class="info">
                      <p>Scumbag Steve</p>
                    </div>
                    <img src="https://i.imgflip.com/i9eg5.jpg">
                  </li>
                  <li data-id="3" data-src="http://i.imgur.com/uGNb9El.jpg" class="meme-initial">
                    <div class="info">
                      <p>Scumbag Steve</p>
                    </div>
                    <img src="http://i.imgur.com/uGNb9El.jpg">
                  </li>
                  <li data-id="4" data-src="/img/logo-fb.png" class="meme-initial">
                    <div class="info">
                      <p>Scumbag Steve</p>
                    </div>
                    <img src="/img/logo-fb.png">
                  </li>
                  <li data-id="5" data-src="http://i.imgur.com/ygISqep.jpg" class="meme-initial">
                    <div class="info">
                      <p>Scumbag Steve</p>
                    </div>
                    <img src="http://i.imgur.com/ygISqep.jpg">
                  </li>
                </ul>
              </div>
              <div class="step step-2">
                <img id="start-image" src="" alt="" style="display: none" />
                <canvas id="memecanvas">
                  Sorry, canvas not supported
                </canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="inside box text">
          <header>
            <p>Dodaj tekst</p>
          </header>
          <div class="content">
            <form method="POST" class="ustvari-form">
              <input type='text' placeholder="Zgornji tekst" value='' id='top-text' class="form-control" disabled />
              <input type='text' placeholder="Spodnji tekst" value='' id='bottom-text' class="form-control" disabled />
                  <ul class="btns">
                    <li>
                      <button id="reset" class="btn btn-danger" disabled>Resetiraj</button>
                    </li>
                    <li>
                      <button id="submit" class="btn btn-success" disabled>Shrani</button>
                    </li>
                  </ul>
              {{ csrf_field() }}
            </form>
          </div>

        </div>      
      </div>
    </div>
</div>
@endsection
