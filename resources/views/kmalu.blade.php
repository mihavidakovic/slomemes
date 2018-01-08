<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Description" content="Najboljši slovenski memesi ustvarjeni z našim novim meme generatorjem!" />
    <meta name="Keywords" content="slo memes, slo, memes, memeji, slovenian_memes, slovenian memes, smešne slike, zabavne slike, vici, vic, smešno, lol" />
    <meta name=“robots” content=index,follow>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Slomemes</title>
    <meta property="og:url"                content="{{url()->current()}}" />
	<meta property="og:title"              content="Kmalu prihaja Slomemes.si!" />
	<meta property="og:description"        content="Na slovensko sceno prihaja najboljša meme spletna skupnost. Kmalu!" />
	<meta property="og:image"              content="http://slomemes.si/img/logo-fb.png" />
	<meta property="fb:app_id"              content="239832329821923" />

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.atwho.css') }}" rel="stylesheet">
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800" rel="stylesheet">
    
    <!-- Scripts -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="{{ asset('js/meme-generator.js') }}"></script>
    @yield('js')
    <script src="/js/jquery.caret.js"></script>
    <script src="/js/jquery.atwho.js"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script type="text/javascript" src="/js/index.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    @yield('css')
</head>
<body onload="pridobiPoste()" class="kmalu-body">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/sl_SI/sdk.js#xfbml=1&version=v2.8&appId=239832329821923";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <div id="app">
    	<div class="kmalu">
    		<div class="center">
		    	<h1><a href="#"><img src="img/logo.png"></a></h1>
		    	<h2>Kmalu pride na slovensko sceno najboljša meme spletna skupnost!</h2>
		    	<h3>Nekaj awesome funkcij: <span>meme ustvarjalnik</span>, <span>forum</span>, <span>dosežki</span>, ...</h3>
		    	<ul class="sharing">
	    		 	<li class="fb" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=http://slomemes.si');return false"><i class="ion-social-facebook ion"></i> Deli na Facebook-u</li>
		    		<li class="msg" onclick="window.open('fb-messenger://share?link=http://slomemes.si');return false"><img src="img/messenger.svg" width="15">Pošlji kot sporočilo</li>
		    	</ul>
		    </div>
    	</div>
    </div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-70811643-2', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
