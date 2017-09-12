@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Sections</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="box box-primary">
            <div class="box-body">
	            <div class="table-responsive">
	            	<table class="table table-bordered table-hover">
	            		<tr>
	            			<td>No</td>
	            			<td>Display Name</td>
	            			<td>Actions</td>
	            		</tr>
	            		<?php $no = 1; ?>
	            		@foreach($sections as $section)
	            		<tr>
	            			<td width="50">{{$no++}}</td>
	            			<td>{{$section->display_name}}</td>
	            			<td width="100">
	            			@if($section->type == 'single')
	            				<a href="{{route('sections.manage', $section->id)}}" class="btn btn-danger"><i class="ion-ios-copy-outline"></i> Manage</a>
	            			@elseif($section->type == 'loop')
	            				<a href="{{route('sections.manage.list', $section->id)}}" class="btn btn-danger"><i class="ion-ios-copy-outline"></i> Manage</a>
	            			@endif
	            			</td>
	            		</tr>
	            		@endforeach
	            	</table>
	            </div>
            </div>
        </div>
    </div>
@endsection