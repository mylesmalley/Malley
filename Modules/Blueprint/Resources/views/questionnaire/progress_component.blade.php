<div>
    <div class="card border-secondary">
        <div class="card-header bg-secondary text-white">
            Progress So Far
        </div>
        <table class="table table-striped">
            <tbody>
            @forelse( $progress as $p )
                <tr>
                    <td> {{ $p->question }}</td>
                    <td> {{ $p->answer }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">
                        As you answer questions, you will see them appear here.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
</div>
