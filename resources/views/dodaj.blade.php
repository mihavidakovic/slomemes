@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row subpage dodaj">
      <div class="col-lg-8 col-md-8 col-sm-8" style="margin-bottom: 20px; float: left;">
        <div class="inside box">
          <header>
            <p>Dodaj meme</p>
          </header>
          <div class="content">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST">
              <div class="form-group">
                <label for="title">Naslov</label>
                <input type="text" class="form-control" id="title" placeholder="Nakaj izvirnega" name="title">
              </div>
              <div class="form-group">
                <label for="url">URL naslov</label>
                <input type="text" class="form-control" id="url" placeholder="http://" name="url">
              </div>
              {{ csrf_field() }}
              <button type="submit" class="btn btn-default">Dodaj</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4">
        <div class="inside box">
          <header>
            <p>Stranska vrstica</p>
          </header>
          <div class="content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>

        </div>      
      </div>
    </div>
</div>
@endsection
