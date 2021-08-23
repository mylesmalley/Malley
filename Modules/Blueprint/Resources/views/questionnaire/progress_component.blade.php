<div>
    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
            Progress
        </div>
        <table class="table table-striped">
            <tbody>
            @foreach( $progress as $p )
                <tr>
                    <td> {{ $p->question }}</td>
                    <td>  {{ $p->answer }}
                    <!--                                ({{ $p->wizard_answer_id }}) -->
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>
