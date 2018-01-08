<div class="comments-header">
  <h3>Komentarji (<span class="num-comments">0</span>)</h3>
  <div class="hide-comments" data-toggle="tooltip" data-placement="left"  title="Skrij komentarje"><i class="ion ion-eye"></i></div>
</div>
<ul class="comments">
</ul>
 <div class="add-comment">
   <form method="POST" action="" class="commentForm">
    {!! mention()->asTextArea('content', old('content'), 'users', 'name', 'type-comment', 'lol') !!}
     <button type="submit" class="btn btn-default"><i class="ion ion-android-send"></i></button>
     {{ csrf_field() }}
   </form>
 </div> 