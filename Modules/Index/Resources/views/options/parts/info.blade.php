<div class="card border-primary">
    <div class="card-header bg-primary text-white">About</div>
    <table class="table table-sm">
        <tbody>
            <tr>
                <td>Name</td>
                <td>{{ $option->fullName }}</td>
            </tr>
            <tr>
                <td>Description</td>
                <td>{{ $option->option_description }}</td>
            </tr>
            <tr>
                <td>Revision</td>
                <td>{{ $option->revision }} {{ $option->user ? "({$option->user->first_name})" : "" }}</td>
            </tr>
            <tr>
                <td>Date Created</td>
                <td>{{ $option->created_at }}</td>
            </tr>
            <tr>
                <td>Tags
                    @if( !$option->obsolete )
                        @if( Auth::user()->can_edit_options )

                            <a href="{{ url('/index/option/'.$option->id.'/tags') }}"
                               class='btn btn-sm btn-outline-dark float-right'>Edit</a>
                        @endif
                    @endif
                </td>
                <td>
                    @foreach( $option->tags as $tag )
                    <a
                            href="{{ url("/index/{$option->base_van_id}?filter={$tag->id}") }}"
                            class="badge bg-dark">




                        {{ $tag->name }}</a>
                @endforeach
                </td>
            </tr>
        </tbody>
    </table>
</div>
