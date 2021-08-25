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
                    <td> {{ $p->answer }} <br>

                        @foreach( DB::table('wizard_actions')
                            ->where('wizard_answer_id', $p->wizard_answer_id)
                            ->leftJoin('options', 'options.id', '=', 'wizard_actions.option_id')
                             ->get() as $action)
                            <small class="text-secondary">
                                {{ $action->action }}
                                <a href="{{ route('option.home', [$action->option_id ]) }}">
                                    {{ $action->option_name }} {{ $action->option_description }}</a>
                            </small><br>
                            @endforeach
                    </td>
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
