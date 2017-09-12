@if(isset($edit) == true)
	<input type="hidden" name="_method" value="PUT">
@endif

<div class="form-group col-md-12">
	<h4>Section</h4>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group col-md-12">
			<label>Namespace</label>
			<div class="form-control">{{$section->namespace}}</div>
		</div>

		<div class="form-group col-md-12">
			<label>Display Name</label>
			<div class="form-control">{{$section->display_name}}</div>
		</div>
	</div>
</div>

<div class="form-group col-md-12">
	<h4>Content</h4>
</div>

<div class="form-group">
	<div class="col-md-12">
		<ul class="nav nav-tabs lang-tab">
			@foreach(localization() as $i => $locale)
			  <li{{($i==0 ? ' class=active':'')}}><a href="#{{$locale->namespace}}" role="tab" data-toggle="tab">{{$locale->name}}</a></li>
		  @endforeach
		</ul>		
	</div>	
</div>

<?php $content = json_decode($section['content']); 

if(!empty($section->section_details)) {
	$section_details_content = json_decode(@$section->section_details[0]->content);
}

if($section->type == 'loop' && isset($detail)) {
	$values = [];
	foreach($detail as $sec) {
		$values[$sec->lang] = json_decode($sec->content);
	}	
}

if($section->type == 'single') {
	$values = [];
	foreach($section->section_details as $sec) {
		$values[$sec->lang] = json_decode($sec->content);		
	}
}
?>

<div class="tab-content">
	@foreach(localization() as $i => $locale)
	<div class="tab-pane{{$i==0?' active':''}}" id="{{$locale->namespace}}">
		@foreach($content as $item)
			<?php
				fieldtype($item, ($section->type == 'loop' && !@$edit ? '' : $values), $locale);
			?>
		@endforeach
	</div>
	@endforeach
</div>

<div class="form-group col-md-12">
	<button class="btn btn-primary">Save Changes</button>
	<a class="btn btn-default" href="javascript:history.back(-1);">Cancel</a>
</div>

@section('scripts')
<script>
var link = $("[data-link]");
link.attr('readonly', true);
link.val(slugify($("[data-title]").val()));
$("[data-title]").keyup(function() {

	$("[data-link]").val(slugify($(this).val()))

});

function slugify(text)
{
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
}
</script>

@endsection
