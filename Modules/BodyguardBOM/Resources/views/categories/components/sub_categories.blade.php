<div class="card border-secondary">
    <div class="card-header bg-secondary text-white">
        <h5>Sub Categories</h5>
    </div>
    <table class="table table-striped table-hover">
        <tbody>
        @forelse( $category->children as $child )
                <tr>
                    <td>
                        <a href="{{ route('bg.categories.show', [$child->id]) }}">
                            {{ $child->name }}
                        </a>
                        </td>
                </tr>
            @empty
                <tr>
                    <td colspan="1000">No sub-categories</td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>