@extends('frontend.master', ['staticbar' => true])
@section('title', $post->title)

@section('content')
		<section class="section about about-page">
			<div class="container">
				<h2 class="section-title">
					{{section('section_news', 'title')}}
				</h2>
				<div class="section-body">
					<div class="row">
						<div class="col-md-8">
							<article>
								<div class="inner">
									<figure class="bg-image" data-image="{{url($post->thumbnail)}}">
									</figure>
									<div class="desc">
									<div>
										<h2>{{$post->title}}</h2>
										<p style="font-size: 12px;text-transform: uppercase;margin-top: -12px"><i>{{__('master.Posted')}}: {{$post->created_at->diffForHumans()}}</i></p>
										<hr>
									</div>

										{!! $post->description !!}


									</div>
								</div>
							</article>
						</div>
						<div class="col-md-4">
							@include('frontend.parts.sidebar')
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection