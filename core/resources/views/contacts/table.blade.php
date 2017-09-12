<table class="table table-responsive" id="contacts-table">
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>subject</th>
        <th>Message</th>
        <th>Details</th>
        <th>Dikirim Pada</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($contacts as $contact)
        <tr>
            <td>{!! $contact->name !!}</td>
            <td>{!! $contact->email !!}</td>
            <td>{!! $contact->subject !!}</td>
            <td>{!! $contact->message !!}</td>
            <td>{!! $contact->details !!}</td>
            <td>{!! date("d M Y", strtotime($contact->created_at)) !!}</td>
            <td>
                {!! Form::open(['route' => ['contacts.destroy', $contact->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('contacts.show', [$contact->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {{-- <a href="{!! route('contacts.edit', [$contact->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a> --}}
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>