@extends('frontend.master', ['secondarybar' => false])
@section('title', 'Xaerus')
@section('content')
		@include('frontend.parts.slider')


		<style>
			.prod-inner {
				border: solid 1px;
				border-radius: 5px;
				border-color: #80B53F;
				border-spacing: 5px;
				height: 480px;
				position: relative;
			}

			.prod-bg-image {
				border-radius: 5px 5px 0px 0px;
				height: 250px;
			}

			.prod-text {
				padding: 15px;
			}

			.prod-selengkapnya {
				height: 50px !important;
				text-transform: uppercase !important;
				font-size: 15px !important; 
				line-height: 27px;
				width: 100% !important;
				border-radius: 0px 0px 4px 4px !important;
				background-color: #80b53f !important;
				color: #ffffff !important;
				position: absolute; 
				bottom: 0px !important;
			}

			
		</style>

		<section class="section bg-image white about visible-md visible-lg" data-image="/img/bg.gif">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">				
						<h2 class="section-title">
							{{section('section_about','title')}}
						</h2>
						<div class="section-body">
							<div class="tab-content">
								@foreach(section('about_us') as $i=>$about)
								<div class="tab-pane {{$i==0?'active':''}}" id="tab{{$i}}">
									<div class="title-tab">{{$about->title}}</div>
									<p class="content-tab text-justify">
									{{ substr(strip_tags($about->content),0,289) }}...
									</p>
									<div class="cta-tab">
										<a href="/about" class="btn btn-outline">{{$about->button_text}}</a>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="section bg-image white about hidden-lg hidden-md" data-image="/media/images/shares/thumbs/bg-about.jpg">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">				
						<h2 class="section-title">
							{{section('section_about','title')}}
						</h2>
						<div class="section-body">
							<div class="tab-content">
								@foreach(section('about_us') as $i=>$about)
								<div class="tab-pane {{$i==0?'active':''}}" id="tab{{$i}}">
									<div class="title-tab">{{$about->title}}</div>
									<p class="content-tab text-justify">
									{{ substr(strip_tags($about->content),0,289) }}...
									</p>
									<div class="cta-tab">
										<a href="/about" class="btn btn-outline">{{$about->button_text}}</a>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="section">
			<div class="container">
				<h2 class="section-title">{{section('section_product', 'title')}}</h2>
				<div class="section-body">
					<div class="row">
						@foreach(section('product_range', 4) as $product)

						<a href="/product-details/{{$product->link}}" style="text-decoration: none;color: #000">
							<div class="col-md-4 col-sm-4">
								<article>
									<div class="prod-inner">
										<figure class="bg-image prod-bg-image" data-image="{{url($product->image)}}">
										</figure>
										<div class="desc prod-text">
											<h2 class="prod-title">{{$product->title}}</h2>
											<p>
												{!! substr(strip_tags($product->description), 0, 100) !!}...
											</p>
										
										</div>

										<div class="cta">
											<a href="/product-details/{{$product->link}}" class="btn btn-outline prod-selengkapnya">
												{{$product->button_text}}
											</a>
										</div>
									</div>
								</article>
							</div>
						</a>

						@endforeach
					</div>
				</div>
			</div>
		</section>

		<section class="section client">
			<div class="container">
				<h2 class="section-title">
					{{section('section_client', 'title')}}
				</h2>
				<div class="section-body">
					<ul id="our-client" class="owl-carousel owl-theme">
						@foreach(section('our_client') as $client)
						<li><a href="{{$client->link}}"><img src="{{url($client->image)}}"></a></li>
						@endforeach
					</ul>
				</div>
			</div>
		</section>

		@include('frontend.parts.contact')

		<section class="section maps">
			<div class="text">
				{{__('master.Locate Us On The Map')}}
			</div>
			<iframe src="{{section('maps', 'link')}}" width="{{section('maps', 'width')}}" height="{{section('maps', 'height')}}" style="border:none;"></iframe>
		</section>
@endsection
@section('js')
<script type="text/javascript">
	var owl = $('.owl-carousel');
	owl.owlCarousel({
	    items: '{{count(section('our_client'))}}',
	    loop: true,
	    margin:10,
	    autoPlay:true,
	    autoPlayTimeout: 1000,
	    autoPlayHoverPause:true
	});
	owl.trigger('play.owl.autoplay',[1000])
</script>
@endsection