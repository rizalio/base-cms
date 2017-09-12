                <div class="row">
                @if(isset($categories_edit))
                    {!! Form::model($categories_edit, ['route' => ['categories.update', $categories_edit->id], 'method' => 'patch', 'class' => 'col-md-12']) !!}
                    @else
                    {!! Form::open(['route' => 'categories.store', 'autocomplete' => 'off', 'class' => 'col-md-12']) !!}
                    @endif

                        @include('categories.fields')

                    {!! Form::close() !!}
                </div>
