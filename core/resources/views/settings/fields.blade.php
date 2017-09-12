<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Display Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('display_name', 'Display Name:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-6 col-lg-6">
    {!! Form::label('type', 'Field Type:') !!}
    <select class="form-control" name="details[type]">
    	<option value="text">Text</option>
    	<option value="textarea">Textarea</option>
    	<option value="textarea_rich">Rich Textarea</option>
    	<option value="files_all">File: All Files</option>
    	<option value="files_images">File: Images</option>
    	<option value="date">Date</option>
    </select>
</div>

<div class="form-group col-sm-6">
	<label>Group</label>
	<input type="text" name="setting_group" class="form-control">
	<div class="help-block">* write in lowercase</div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('settings.index') !!}" class="btn btn-default">Cancel</a>
</div>
