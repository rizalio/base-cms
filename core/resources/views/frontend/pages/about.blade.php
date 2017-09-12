@extends('frontend.master', ['staticbar' => true])
@section('title', __('master.About Us'))

@section('content')
	@include('frontend.parts.slider')

		<section class="section about about-page">
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
									{!! $about->content !!}
									</p>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection