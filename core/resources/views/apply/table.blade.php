<table class="table table-responsive" id="contacts-table">
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>File</th>
        <th>Position</th>
        <th>Details</th>
    </thead>
    <tbody>
    @foreach($apply as $item)
    <?php 
        $message = json_decode($item->message);
    ?>
        <tr>
            <td>{!! $item->name !!}</td>
            <td>{!! $item->email !!}</td>
            <td>{!! $item->phone !!}</td>
            <td><a href="{!! route('apply.file', $message->file) !!}">Resume</a></td>
            <td>{!! $message->position !!}</td>
            <td>{!! $item->details !!}</td>
        </tr>
    @endforeach
    </tbody>
</table>