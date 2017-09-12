<table class="table table-responsive" id="settings-table">
    <thead>
        <th>Name</th>
        <th>Display Name</th>
        <th>Details</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($settings as $settings)
    <?php $details = json_decode($settings->details); ?>
        <tr>
            <td>{!! $settings->name !!}</td>
            <td>{!! $settings->display_name !!}</td>
            <td>Field Type: {!! $details->type !!}</td>
            <td>
                {!! Form::open(['route' => ['settings.destroy', $settings->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('settings.show', [$settings->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('settings.edit', [$settings->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>