@extends('frontend.master', ['staticbar' => true])
@section('title', __('master.Search'))

@section('content')
		<section class="section">
			<div class="container">
				<h2 class="section-title">
					{{__('master.Search')}}: {{$q}}
				</h2>
				<div class="section-body">
					<div class="row">
						<div class="col-sm-12">
							<div class="row">
								@foreach($blogs as $post)
								<div class="col-md-4">
									<article>
										<div class="inner">
											<a href="{!! route('frontend.single',$post->slug) !!}">
												<figure class="bg-image" data-image="{{url($post->thumbnail)}}">
												</figure>
											</a>
											<div class="desc">
												<h2><a href="{!! route('frontend.single',$post->slug) !!}">{{$post->title}}</a></h2>
												{{substr(strip_tags($post->description),0,200)}}
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
					</div>
				</div>
			</div>
		</section>
@endsection