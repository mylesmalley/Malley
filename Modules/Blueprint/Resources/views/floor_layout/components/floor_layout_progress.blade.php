<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        What will be added to the quote and BOM
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            @forelse( $formatted_progress as $p )
                <tr>
                    <td>
                        <a href="{{ route('option.home', [$p->id]) }}">
                            {{ $p->option_name }}
                        </a>
                        </td>
                    <td>{{ $p->option_description }}</td>
                    <td>{{ $p->count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nothing added yet</td>
                </tr>
            @endforelse
        </tbody>
    </table>
{{--    <div class="card-footer">--}}
{{--        <form action="{{ route('blueprint.floor_layout.store', [$blueprint]) }}"--}}
{{--            method="POST">--}}
{{--            @csrf--}}
{{--            <button type="submit" class="btn btn-success">--}}
{{--                Confirm Floor &amp; Seat Layout--}}
{{--            </button>--}}
{{--        </form>--}}
{{--    </div>--}}
</div>