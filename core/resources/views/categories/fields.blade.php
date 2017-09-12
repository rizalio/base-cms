<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', null, ['class' => 'form-control title']) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-12">
    {!! Form::label('slug', 'Slug') !!}
    {!! Form::text('slug', null, ['class' => 'form-control slug']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('image', 'Image') !!}
    <div class="input-group">
        <div class="input-group-btn" data-fm="true" data-preview="prv" data-input="photo">
            <a class="btn btn-primary"><i class="ion-image"></i> Pilih Gambar</a>
        </div>
        {!! Form::text('image', null, ['class' => 'form-control', 'id' => 'photo']) !!}
    </div>
</div>

<!-- Parent Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('parent_id', 'Parent') !!}
    <select class="form-control" name="parent_id">
        <option value="0">None</option>
        @foreach($parent_cat as $item)
            <option value="{{$item->id}}" <?=$item->id == @$categories_edit->parent_id ? 'selected':'';?>>{{$item->name}}</option>
            @if($item->childs)
                @foreach($item->childs as $c)
                    <option value="{{$c->id}}" <?=$c->id == @$categories_edit->parent_id ? 'selected':'';?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$c->name}}</option>
                @endforeach
            @endif
        @endforeach
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    @if(isset($categories_edit))
    {!! Form::submit('Update Kategori', ['class' => 'btn btn-primary']) !!}
    @else
    {!! Form::submit('Tambah Kategori', ['class' => 'btn btn-primary']) !!}
    @endif
    @if(isset($categories_edit))
    <a href="{{route('categories.index')}}" class="btn btn-default">Cancel</a>
    @endif
</div>

@section('scripts')
<script>
    $(".title").keyup(function(){
        var val = $(this).val();
        val = val.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
        $(".slug").val(val);
    });
</script>
@endsection