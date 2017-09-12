<table class="table table-responsive" id="localizations-table">
    <thead>
        <th>Name</th>
        <th>Dir</th>
        <th>Namespace</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($localizations as $localization)
        <tr>
            <td>{!! $localization->name !!}</td>
            <td>{!! $localization->dir !!}</td>
            <td>{!! $localization->namespace !!}</td>
            <td>
                {!! Form::open(['route' => ['localizations.destroy', $localization->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('localizations.show', [$localization->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="top" data-title="Details"><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('localizations.edit', [$localization->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="top" data-title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="{!! ($localization->default_lang) ? 'javascript:void()' : route('localizations.set_default', ['lang_id' => $localization->id]) !!}" class='btn {{($localization->default_lang) ? 'btn-success' : 'btn-default'}} btn-xs' data-toggle="tooltip" data-placement="top" data-title="{{($localization->default_lang) ? 'This is default language' : 'Set as default language'}}"><i class="glyphicon glyphicon-check"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>
@endsection