@extends('layouts.app')

@section('content')
<?php 
if(!empty($sections)) {
$content = $sections->content; 
$section_content = json_decode($content);
}
?>
    <section class="content-header">
        <h1>
            <a href="{{route('sections.index')}}">Manage Section</a>
            @if(isset($sections))
            &nbsp; &rsaquo; &nbsp; {{$sections->display_name}}
            <a href="{{route('sections.manage', $sections->id)}}" class="btn btn-primary pull-right">Add {{$sections->display_name}}</a>
            @else
            &nbsp; &rsaquo; &nbsp; {{$section->display_name}}
            @endif
        </h1>
    </section>
    @if(isset($list) == true)
    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
	                <div class="col-md-12">
		                <div class="table-responsive">                	
			                <table class="table table-bordered datatables">
			                <thead>
			                	<tr>
				                	<th width="20">No</th>
					                @foreach($section_content as $item)
			                		<th>{{@$item->display_name}}</th>
				                	@endforeach
				                	<th>Actions</th>
			                	</tr>
			                	</thead>
			                	@if(count($details) == 0)
			                	<tbody>
			                		<tr>
			                			<td colspan="{{count($section_content) + 2}}" align="center">No Data</td>
			                		</tr>
			                	</tbody>
			                	@else
			                	<tbody>
			                	<?php $no=1;?>
			                	@foreach($details as $detail)
			                	<?php $detail_content = json_decode($detail->content); ?>
			                		<tr>
			                		<td>{{$no++}}</td>
					                @foreach($section_content as $item)
			                			<td width="100">
				                			@if($item->type == 'files_images')
				                				<img src="{!! url($detail_content->{$item->name}) !!}" width="100">
				                			@elseif($item->type == 'textarea' || $item->type == 'textarea_rich')
				                				{!! strip_tags(substr($detail_content->{$item->name}, 0, 200)) !!}[...]
				                			@elseif(strpos($item->type, 'section_') !== false)
				                				{!! getSectionName(@$detail_content->{$item->name}) !!}
			                				@else
				                				{!! @$detail_content->{$item->name} !!}
			                				@endif
			                			</td>
				                	@endforeach
					                	<td width="10">
						                		<form action="{{route('sections.manage.delete', [$sections->id, $detail->gen_id])}}" onsubmit="return confirm('Are you sure?')" method="post">
							                		{!! csrf_field() !!}
							                		<input type="hidden" name="_method" value="DELETE">
							                		<a href="{{route('sections.manage.edit', [$sections->id, $detail->gen_id])}}" class="btn btn-warning btn-sm btn-block">Edit</a>
							                		<button class="btn btn-danger btn-sm btn-block">Delete</button>
						                		</form>
					                	</td>
			                		</tr>
			                	@endforeach
			                	</tbody>
			                	@endif
			                </table>
		                </div>
	                </div>
                </div>
            </div>
        </div>
    </div>    
    @else
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                @if(isset($edit) == true)
                    {!! Form::open(['route' => ['sections.manage.update', $section->id, $gen_id]]) !!}
                @else
                    {!! Form::open(['route' => ['sections.store_design', $section->id]]) !!}
                @endif
                        @include('sections.fields_design')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
