@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Dashboard</h1>
    </section>
    <section class="content">
    	<div class="row">
    		<div class="col-md-12">
        	<div class="well">
	          <h1>Selamat datang, {{Auth::user()->name}}!</h1>
	          <p class="lead">
	          	Disini Anda dapat melakukan mengelola data news, users, section dan lain-lain.
	          </p>
	          <p>
	          	<a href="" class="btn btn-primary btn-flat">Kelola Sections</a>
	          </p>
       	 	</div>
        </div>
      </div>
			<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Users</span>
              <span class="info-box-number">{{$users}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-motorcycle"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sections</span>
              <span class="info-box-number">{{$sections}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-building"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Posts</span>
              <span class="info-box-number">{{$posts}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion-airplane"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Contacts</span>
              <span class="info-box-number">{{$contacts}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
    </section>

@endsection