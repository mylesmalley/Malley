<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        <h2>Parts in this category</h2>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Number</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @forelse( $category->parts as $part )
                <tr onclick="location.href = '{{ route('bg.parts.show', [$part]) }}'">
                    <td>{{ $part->part_number }}</td>
                    <td>{{ $part->description }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="1000">No parts in this cateogry</td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>