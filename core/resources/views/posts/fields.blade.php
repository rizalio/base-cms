<!-- Thumbnail Field -->
<div class="form-group col-sm-4">
    {!! Form::label('thumbnail', 'Thumbnail:') !!}
    <div class="input-group">
        {!! Form::text('thumbnail', null, ['class' => 'form-control', 'id' => 'thumbnail']) !!}
        <div class="input-group-btn">
            <a class="btn btn-primary" data-fm="true" data-input="thumbnail">Pick Image</a>
        </div>
    </div>
</div>

<!-- Product Category Field -->
<div class="form-group col-sm-4">
    {!! Form::label('category_id', 'Category') !!}
    <select class="form-control" name="category_id">
        <option value="0">None</option>
        @foreach($categories as $item)
            <option value="{{$item->id}}" <?=$item->id == @$posts->category_id ? 'selected':'';?>>{{$item->name}}</option>
            @if($item->childs)
                @foreach($item->childs as $c)
                    <option value="{{$c->id}}" <?=$c->id == @$posts->category_id ? 'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$c->name}}</option>
                    @if($c->childs)
                        @foreach($c->childs as $ca)
                        <option value="{{$ca->id}}" <?=$ca->id == @$posts->category_id ? 'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$ca->name}}</option>
                        @endforeach
                    @endif
                @endforeach
            @endif
        @endforeach
    </select>
</div>

<!-- Status Field -->
<div class="form-group col-sm-4">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['publish' => 'Publish', 'draft' => 'Draft'], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-md-12">
    <ul class="nav nav-tabs lang-tab">
        @foreach(localization() as $i => $locale)
          <li{{($i==0 ? ' class=active':'')}}><a href="#{{$locale->namespace}}" role="tab" data-toggle="tab">{{$locale->name}}</a></li>
      @endforeach
    </ul>
</div>

{!! Form::hidden('slug', null, ['class' => 'form-control slug']) !!}

<div class="tab-content">
    @foreach(localization() as $i => $locale)
    <div class="tab-pane{{$i==0?' active':''}}" id="{{$locale->namespace}}">
        <!-- Title Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('content['.$locale->id.'][title]', (@$edit == true ? $values[$locale->id]['title'] : ''), ['class' => 'form-control title']) !!}
        </div>


        <!-- Description Field -->
        <div class="form-group col-sm-12 col-lg-12">
            {!! Form::label('content['.$locale->id.'][description]', 'Description:') !!}
            {!! Form::textarea('content['.$locale->id.'][description]', (@$edit == true ? $values[$locale->id]['description'] : ''), ['class' => 'form-control tinymce']) !!}
        </div>

    </div>
    @endforeach
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('posts.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<script>
    $(".title:eq(0)").on("keyup",function(){
        var val = $(this).val();
        val = val.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
        $(".slug").val(val);
    });
</script>
@endsection