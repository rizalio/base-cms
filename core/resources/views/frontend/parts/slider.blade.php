		<section class="slider">
			<ul class="owl-carousel owl-theme" id="main-slider">
				@foreach(section('home_slider') as $slide)
				<li>
					<a href="{{$slide->hyperlink}}">
						<img src="{{url($slide->image)}}">
					</a>
				</li>
				@endforeach
			</ul>
			<div class="down slide-down">
				<i class="ion-chevron-down"></i>
			</div>
		</section>
