<table class="table table-responsive" id="posts-table">
    <thead>
        <th>Title</th>
        <th>Category</th>
        <th>Thumbnail</th>
        <th>Status</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($posts as $posts)
        <tr>
            <td>{!! $posts->title !!}</td>
            <td>{!! $posts->category->name !!}</td>
            <td><img src="{!! url($posts->thumbnail) !!}" width="100"></td>
            <td>{!! $posts->status !!}</td>
            <td>
                {!! Form::open(['route' => ['posts.destroy', $posts->gen_id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('posts.edit', [$posts->gen_id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>