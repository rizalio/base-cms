<table class="table table-responsive" id="categories-table">
    <thead>
        <th>Name</th>
        <th>Slug</th>
        <th>Photo</th>
        <th>Dibuat</th>
        <th>Action</th>
    </thead>
    <tbody>
    @foreach($parent_cat as $categories)
        <tr>
            <td>{!! $categories->name !!}</td>
            <td>{!! $categories->slug !!}</td>
            <td><a href="{!! $categories->image !!}">View Photo</a></td>
            <td>{!! $categories->created_at->diffForHumans() !!}</td>
            <td>
                {!! Form::open(['route' => ['categories.destroy', $categories->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('categories.edit', [$categories->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @if($categories->childs)
            @foreach($categories->childs as $sub)
                <tr>
                    <td>
                        &mdash; {{$sub->name}}
                    </td>
                    <td>{{$sub->slug}}</td>
                    <td><a href="{{$sub->image}}">View Photo</a></td>
                    <td>{{$sub->created_at->diffForHumans()}}</td>
                    <td>
                        {!! Form::open(['route' => ['categories.destroy', $sub->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{!! route('categories.edit', [$sub->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>

                @if($sub->childs)
                    @foreach($sub->childs as $sub3)
                        <tr>
                            <td>
                                &mdash;&mdash; {{$sub3->name}}
                            </td>
                            <td>{{$sub3->slug}}</td>
                            <td><a href="{{$sub3->image}}">View Photo</a></td>
                            <td>{{$sub3->created_at->diffForHumans()}}</td>
                            <td>
                                {!! Form::open(['route' => ['categories.destroy', $sub3->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{!! route('categories.edit', [$sub3->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                </div>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                @endif

            @endforeach
        @endif
    @endforeach
    </tbody>
</table>