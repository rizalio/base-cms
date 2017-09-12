<!-- Namespace Field -->
<div class="form-group col-sm-4">
    {!! Form::label('namespace', 'Namespace:') !!}
    {!! Form::text('namespace', null, ['class' => 'form-control']) !!}
</div>

<!-- Display Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('display_name', 'Display Name:') !!}
    {!! Form::text('display_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-4">
    {!! Form::label('type', 'Type:') !!}
    <select name="type" class="form-control">
    	<option value="single" {{(@$sections->type == 'single' ? 'selected' : '')}}>Single</option>
    	<option value="loop" {{(@$sections->type == 'loop' ? 'selected' : '')}}>Loop</option>
    </select>
</div>

<div class="form-group col-sm-12">
	<label>Fields</label>
	<table class="table table-bordered">
		<thead>
			<tr>
				<td>Name</td>
				<td>Display Name</td>
				<td>Type</td>
				<td>Action</td>
			</tr>
		</thead>
		<tbody class="repeat">
		</tbody>
		<tfoot>		
			<tr>
				<td colspan="3"></td>
				<td><button class="btn btn-primary add-more">Add More</button></td>
			</tr>
		</tfoot>
	</table>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sections.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<script>
	$(function() {
		$(".add-more").click(function(){
			add_more();
			return false;
		});

		var count = -1, 
		remove = function(count) {
			console.log(count)
		},
		add_more = function(name, value, type, readonly) {
			if(!name) name = 'Field Name';
			if(!value) value = 'Field Display Name';
			// console.log('add more called!');
			count++;
			var element = "<tr>";
			element += '<td><input type="text" class="form-control" name="content[name]['+count+']" value="'+name+'" '+(readonly == true ? 'readonly' : '')+'></td>';
			element += '<td><input type="text" class="form-control" name="content[display_name]['+count+']" value="'+value+'"></td>';
			element += '<td>';
			element += '	<select class="form-control" name="content[type]['+count+']">';
			element += '<optgroup label="Common">';
			element += '		<option value="text" '+(type == 'text' ? 'selected' : '')+'>Text</option>';
			element += '		<option value="textarea" '+(type == 'textarea' ? 'selected' : '')+'>Textarea</option>';
			element += '		<option value="textarea_rich" '+(type == 'textarea_rich' ? 'selected' : '')+'>Rich Textarea</option>';
			element += '		<option value="files_all" '+(type == 'files_all' ? 'selected' : '')+'>File: All Files</option>';
			element += '		<option value="files_images" '+(type == 'files_images' ? 'selected' : '')+'>File: Images</option>';
			element += '		<option value="date" '+(type == 'date' ? 'selected' : '')+'>Date</option>';
			element += '</optgroup>';
			element += '<optgroup label="Sections">';
			@foreach(availSection() as $sec) 
			element += '		<option value="section_{{$sec->id}}" '+(type == 'section_' + {{$sec->id}} ? 'selected' : '')+'>{{$sec->display_name}}</option>';
			@endforeach
			element += '</optgroup>';
			element += '	</select>';
			element += '</td>';
			element += '<td><a class="btn btn-danger" onclick="$(this).parent().parent().remove()">Remove</a></td>';
			element += '</tr>';
			$(".repeat").append(element);
		}

		@if(!empty($sections))
			@foreach(json_decode($sections->content) as $item)
				add_more('{{$item->name}}', '{{$item->display_name}}', '{{$item->type}}', true)
			@endforeach
		@endif
	});
</script>
@endsection