@extends('frontend.master', ['staticbar' => true])
@section('title', __('master.News & Event'))
@section('css')
	<style>
		.inner {
			height: 460px !important;
			position: relative !important;
		}

		.inner .desc {
			word-wrap: break-word !important;

		}

		.cta {
			position: absolute !important; 
			bottom: 0px !important;
		}
	</style>
@endsection
@section('content')
		<section class="section">
			<div class="container">
				<h2 class="section-title">
					{{section('section_news', 'title')}}
				</h2>
				<div class="section-body">
					<div class="row">
						<div class="col-md-8 col-sm-7">
							<div class="row">
								@foreach($blogs as $post)
								<div class="col-md-6">
									<article>
										<div class="inner">
											<a href="{!! route('frontend.single',$post->slug) !!}">
												<figure class="bg-image" data-image="{{url($post->thumbnail)}}">
												</figure>
											</a>
											<div class="desc" style="word-wrap: break-word !important;">
												<h2 class="title"><a href="{!! route('frontend.single',$post->slug) !!}">{{$post->title}}</a></h2>
												{{substr(strip_tags($post->description),0,200)}}...
												<div class="cta">
													<a href="{{route('frontend.single', $post->slug)}}" class="btn btn-outline">
														{{__('master.Read More')}}
													</a>
												</div>
											</div>
										</div>
									</article>
								</div>
								@endforeach
								<div class="col-md-12">
									<nav class="text-center">
									{!! $blogs->links() !!}
									</nav>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-5">
							@include('frontend.parts.sidebar')
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection