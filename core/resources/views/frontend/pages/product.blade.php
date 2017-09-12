@extends('frontend.master', ['staticbar' => true])
@section('title', __('master.Product Range'))

@section('content')
<?php $section_detail = findSectionItemBy(['name', $type], 'group_product_range'); ?>
	<section class="section product">
		<div class="container">
			<h2 class="section-title">{{section('section_product', 'title')}}</h2>
			<img src="/media/images/shares/xaerus-2.png" style="margin: 0 auto;" class="img-responsive" width="200px">
			<br />
			<div class="section-body">
				<div class="row" id="product-tab">
					@foreach(section('product_range', false, ['parent_group', $section_detail->id]) as $i=>$product)
					<div class="col-md-6 col-sm-6">
						<a href="#tab{{$i}}" class="btn btn-outline btn-block {{$i==0?'active':''}}">{{$product->title}}</a>
					</div>
					@endforeach
				</div>
				<div class="tab-content" >
					@foreach(section('product_range', false, ['parent_group', $section_detail->id]) as $i=>$product)
					<div class="tab-pane {{$i==0?'active':''}}" id="tab{{$i}}">
						<div class="row">
							<div class="col-md-4">
								<figure>
									<img src="{{url($product->image)}}" class="img-responsive">
								</figure>
							</div>
							<div class="col-md-8" style="word-wrap: wrap-reverse !important;">
								{!! $product->description !!}
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
@endsection