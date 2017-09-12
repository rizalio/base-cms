@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Categories</h1>
    </section>
    <div class="clearfix"></div>
    <div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        <div class="col-md-4">
                @include('flash::message')

                <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-body">
                        @include('categories.create')
                    </div>
                </div>
        </div>

        <div class="col-md-8">
                <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-body">
                            @include('categories.table')
                    </div>
                </div>
        </div>
    </div>
    </div>
@endsection

