@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <Slika :id="{{$post->id}}" />
    </div>
</div>
@endsection