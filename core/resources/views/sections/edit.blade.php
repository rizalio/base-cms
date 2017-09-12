@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Sections
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($sections, ['route' => ['sections.update', $sections->id], 'method' => 'patch']) !!}

                        @include('sections.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection