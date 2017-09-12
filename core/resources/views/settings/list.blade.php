@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Settings
        </h1>
    </section>
    <div class="content">
        <div class="row">
		      <div class="col-md-4">
			      <div class="box box-primary">
			      	<div class="box-body">	      		
								<ul class="nav nav-pills nav-stacked" id="mytab">
									<?php $no = 1; ?>
									@foreach($groups as $group)
									  <li class="{{ ($no++ == 1) ? 'active' : '' }}"><a data-toggle="tab" href="#{{$group->setting_group}}">{{human_string($group->setting_group)}}</a></li>
								  @endforeach
								</ul>
			      	</div>
			      </div>
		      </div>
	        <div class="col-md-8">
		        @include('flash::message')
	          {!! Form::open(['route' => 'settings.changes'], ['class' => 'form-control']) !!}
	          {!! csrf_field() !!}
            <input type="hidden" name="_method" value="PUT">
            <div class="tab-content">
						<?php $no = 1; ?>
						@foreach($groups as $group)
						<div class="tab tab-pane {{ ($no++ == 1) ? 'active' : '' }}" id="{{$group->setting_group}}">
			        <div class="box box-primary">
			        <div class="box-header">
			        	<h4>{{human_string($group->setting_group)}}</h4>
			        </div>
			            <div class="box-body">
			                <div class="row col-md-10">

			                    @foreach($settings as $item)
			                   	 	@if($item->setting_group == $group->setting_group)
			                   			<?php $details = json_decode($item->details); ?>
					                    <?php 
					                    $arr = (object) ['name' => $item->name, 'display_name' => $item->display_name, 'type' => $details->type];
					                    $value = (object) [$item->name => $item->value];
					                    setting_fieldtype($arr,$value,'col-md-12');
					                    ?>
					                @endif
			                    @endforeach

			                </div>
			            </div>
			        </div>
						</div>
					  @endforeach
					  </div>
					  <div class="box" style="border: none;">
					  	<div class="box-body">
              	<button type="submit" class="btn btn-primary">Save Changes</button>
					  	</div>
					  </div>

            {!! Form::close() !!}
	        </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
	$('#mytab').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	})
</script>
@endsection