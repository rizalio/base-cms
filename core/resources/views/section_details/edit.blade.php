@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Section Details
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sectionDetails, ['route' => ['sectionDetails.update', $sectionDetails->id], 'method' => 'patch']) !!}

                        @include('section_details.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection