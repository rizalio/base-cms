@extends('frontend.master', ['staticbar' => true])
@section('title', $data['title'])

@section('content')
	<section class="section product">
		<div class="container">
			<h2 class="section-title">{{$data['title']}}</h2>
			<div class="section-body">
				<div class="tab-content" >
					<div class="tab-pane active" id="tab">
						<div class="row">
							<div class="col-md-4">
								<figure>
									<img src="{{url($data['image'])}}" class="img-responsive">
								</figure>
							</div>
							<div class="col-md-8" style="word-wrap: wrap-reverse !important;">
								{!! $data['description'] !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection