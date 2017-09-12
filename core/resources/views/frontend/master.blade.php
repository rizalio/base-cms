<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title')</title>
	  <link href="{{url('css/screen.css')}}" media="screen, projection" rel="stylesheet" />
	  <link href="{{url('css/print.css')}}" media="print" rel="stylesheet" />
	  <!--[if IE]>
	      <link href="css/ie.css" media="screen, projection" rel="styleshee
	t" />
	  <![endif]-->

	  <!-- Bootstrap -->
	  <link rel="stylesheet" href="{{url('scripts/bootstrap/css/bootstrap.min.css')}}">

	  <!-- Ionicons -->
	  <link rel="stylesheet" href="{{url('scripts/ionicons/css/ionicons.min.css')}}">

	  <!-- Owl Carousel -->
	  <link rel="stylesheet" type="text/css" href="{{url('scripts/owlcarousel/dist/assets/owl.carousel.min.css')}}">
	  <link rel="stylesheet" type="text/css" href="{{url('scripts/owlcarousel/dist/assets/owl.theme.default.min.css')}}">

	  <!-- Style -->
	  <link rel="stylesheet" href="{{url('scripts/sweetalert/dist/sweetalert.css')}}">
	  <link rel="stylesheet" href="{{url('scripts/mmenu/jquery.mmenu.all.css')}}">
	  <link rel="stylesheet" href="{{url('css/style.css')}}">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.8.0/css/flag-icon.min.css" />
	
	  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	  <link rel="icon" href="/favicon.ico" type="image/x-icon">
	</head>

	<body>
		<div id="my-page">
		@if(@$staticbar == true)
		<header class="main-header" style="position: static;">
		@else
		<header class="main-header">
		@endif
			<div class="topbar">
				<div class="container">
					<ul class="pull-left links">
						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{!! flag() !!} {{__('master.Language')}} <span class="caret"></span></a>
							<ul class="dropdown-menu">
								@foreach(localization() as $loc)
								<li><a href="{{route('switchlang', $loc->namespace)}}">{{$loc->name}} {!! $loc->id == getLangPlease() ? '<small>(active)</small>':'' !!}</a></li>
								@endforeach								
							</ul>
						</li>
					</ul>
					<ul class="social">
						<li style="margin: 5px;color: #fff;">Email: {{setting('email')}}</li>
						<li style="margin: 5px;color: #fff;">Phone: {{setting('phone')}}</li>
						@foreach(section('social_media') as $social)
							{!! showSocialMedia($social) !!}
						@endforeach	
					</ul>
				</div>
			</div>
			<nav class="navbar">
			  <div class="container">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="{{route('frontend.home')}}">
			      	<img src="{{url(setting('site_logo'))}}" class="img-responsive" alt="{{setting('site_name')}}">
			      </a>
			    </div>

			    <div class="collapse navbar-collapse" id="main-navbar">
			      <ul class="nav navbar-nav navbar-right">
				      <li><a href="{{route('frontend.home')}}">{{__('master.Home')}}</a></li>
				      <li><a href="/product/xaerus-1">{{__('master.Product Range')}}</a></li>
				      <li><a href="{{route('frontend.service')}}">{{__('master.Services')}}</a></li>
				      <li><a href="{{route('frontend.about')}}">{{__('master.About Us')}}</a></li>
				      <li><a href="{{route('frontend.news')}}">{{__('master.News & Event')}}</a></li>
				      <li><a href="{{route('frontend.contact')}}">{{__('master.Contact Us')}}</a></li>
				      <li class="icon-only"><a href="#" class="search-toggle"><i class="ion-search"></i></a></li>
			      </ul>
			    </div>
			  </div>
			</nav>
			<div class="secondary-bar" id="searchbar">
				<div class="container">
					<div class="row">
						<form class="search-form" action="{{route('frontend.search')}}">
							<div class="col-md-4 col-md-offset-6">
								<input type="text" name="q" placeholder="{{__('master.Search on this site')}}" class="form-control">
							</div>
							<div class="col-md-2">
								<button class="btn btn-primary btn-block" type="submit">{{__('master.Search')}}</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="secondary-bar trp40" id="product-range-bar">
				<div class="container">
					<div class="owl-carousel owl-theme" id="secondarybar">			
						@foreach(section('group_product_range') as $item)
						<div class="logo {{$item->name == @$type ? 'active' : ''}}">
							<a href="{{route('frontend.product', $item->name)}}">					
								<img src="{{url($item->logo)}}">
							</a>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</header>
  <div class="mobile-nav">
    <div class="mobile-nav-row">
      <div class="mobile-nav-item mobile-toggle"  data-no-turbolink='true'>
        <a rel="nofollow" rel="noreferrer" href="#mobile-nav-side" data-no-turbolink='true'><i class="ion-navicon"></i></a>
      </div>
      <div class="mobile-nav-item mobile-brand">
        <a href="{{route('frontend.home')}}">
          <img src="{{url(setting('site_logo_mobile'))}}">
        </a>
      </div>
      <div class="mobile-nav-item mobile-cart">
      </div>      
    </div>
    <div class="mobile-nav-row">
      <div class="mobile-nav-item mobile-search-form">
        <form action="{{route('frontend.home')}}">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{__('master.Search on this site')}}" value="{{isset(request()->q) ? request()->q :''}}">
                <div class="input-group-btn">
                    <button class="btn btn-primary" type="submit">
                        <i class="ion-search"></i>
                    </button>
                </div>
            </div>
        </form>        
      </div>
    </div>
  </div>
  <div class="mobile-nav-side" id="mobile-nav-side">
    <ul class="mobile-nav-list">
	      <li><a href="{{route('frontend.home')}}">{!! flag() !!} {{__('master.Language')}}</a>
		      <ul>
						@foreach(localization() as $loc)
						<li><a href="{{route('switchlang', $loc->namespace)}}">{{$loc->name}}</a></li>
						@endforeach
		      </ul>
	      </li>
	      <li><a href="{{route('frontend.home')}}">{{__('master.Home')}}</a></li>
	      <li><a href="#">{{__('master.Product Range')}}</a>
		      <ul>
			      @foreach(section('group_product_range') as $item)
		      	<li><a href="{{route('frontend.product', $item->name)}}">{{$item->display_name}}</a></li>
		      	@endforeach
		      </ul>
	      </li>
	      <li><a href="{{route('frontend.service')}}">{{__('master.Services')}}</a></li>
	      <li><a href="{{route('frontend.about')}}">{{__('master.About Us')}}</a></li>
	      <li><a href="{{route('frontend.news')}}">{{__('master.News & Event')}}</a></li>
	      <li><a href="{{route('frontend.contact')}}">{{__('master.Contact Us')}}</a></li>
     </ul>
    </div>

		@yield('content')

		<footer class="main-footer">
			<div class="up slide-up">
				<i class="ion-chevron-up"></i>
			</div>
			<div class="text">
				{!! section('footer', 'text') !!}
				<br>
				<p style="font-size: 10px;">WEBSITE CREATED BY <a href="http://procyon.co.id">PROCYON</a></p>
			</div>
		</footer>
		</div>

		<script src="{{url('scripts/jquery-3.2.1.min.js')}}"></script>
		<script src="{{url('scripts/jquery.easing.1.3.js')}}"></script>
		<script src="{{url('scripts/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{url('scripts/owlcarousel/dist/owl.carousel.min.js')}}"></script>
		<script src="{{url('scripts/owlcarousel/src/js/owl.autoplay.js')}}"></script>
		<script src="{{url('scripts/sweetalert/dist/sweetalert.min.js')}}"></script>
		<script src="{{url('scripts/mmenu/jquery.mmenu.all.js')}}"></script>
		<script>var base_url="{{url('')}}";</script>
		<script src="{{url('js/custom.js')}}"></script>
		<script>
    var ready;
    ready = function() {
        $('html').removeAttr( 'class' );
        $.mmenu.glbl = false;

         $("#mobile-nav-side").mmenu({
           "extensions": [
              "theme-dark", "pagedim-black"
           ],
           "navbars": [
              {
                 "position": "top"
              },
              {
                 "position": "bottom",
                 "content": [
                    @foreach(section('social_media') as $social)
                    	'{!! showSocialMedia($social) !!}',
                    @endforeach
                 ]
              }
           ],
           "offCanvas": {
              "zposition": "front"
           }
          });
    };
    $(document).ready(ready);
    $(document).ready(function() {
    	var owl = $('.owl-carousel');
    	owl.owlCarousel({
    	    items: 4,
    	    loop: true,
    	    margin:10,
    	    autoplay: true,
            autoplaySpeed: 500,
            autoplayTimeout: 50000
    	})
    	owl.trigger('play.owl.autoplay',[1000, 1000])
    });
		</script>
		@yield('js')
	</body>
</html>