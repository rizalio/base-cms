@extends('frontend.master', ['staticbar' => true])
@section('title',__('master.Services'))

@section('content')
	<section class="section service">
		<div class="container">
			<h2 class="section-title">{{section('section_service', 'title')}}</h2>
			<div class="section-body">
				<div class="row" id="service-tab">
					@foreach(section('services') as $i=>$service)
					<div class="col-md-4 col-sm-4">
						<a href="#tab{{$i}}" class="btn btn-outline btn-block {{$i==0?'active':''}}">{{$service->title}}</a>
					</div>
					@endforeach
				</div>
				<div class="tab-content">
					@foreach(section('services') as $i=>$service)
					<div class="tab-pane {{$i==0?'active':''}}" id="tab{{$i}}">
						<div class="row">
							<div class="col-md-4">
								<figure>
									<img src="{{url($service->image)}}" class="img-responsive">
								</figure>
							</div>
							<div class="col-md-8">
								{!! $service->content !!}
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
@endsection