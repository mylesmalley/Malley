<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        <h3>#{{ $bug->id  }} {{ $bug->title }} - Priority: {{ round($bug->priority) }}% - Urgency: {{ $bug->urgencyLabel }}
            <a href="{{ url('bugs/'.$bug->id  ) }}" class='btn btn-secondary float-end'>Open Project</a>
        </h3>
    </div>
    <div class="card-body">
        <p>{{ $bug->user_notes ?? "No description" }}</p>
    </div>
    <table class="table table-sm">
        <tbody>
        @foreach( $bug->activities as $activity )

            <tr class="
                @if( $activity->completed )
                    bg-success
                @elseif( ($bug->nextSequence() == $activity->sequence )  && ( $activity->assigned_user_id == $user->id ) )
                    bg-danger
                    @elseif( $bug->nextSequence() !== $activity->sequence    && $activity->assigned_user_id == $user->id )
                    bg-warning
                    @else
{{--                bg-info--}}
                @endif
                ">


{{--                <td>{{ $bug->nextSequence() }} {{ $activity->sequence }}, {{ $activity->assigned_user_id }}, {{ $user->id }}</td>--}}
                <td> {{ $activity->sequence }}</td>
                <td> {{ $activity->title }}</td>
                <td> {{ $activity->assignedUser->first_name }}</td>
                <td> {{ $activity->due_date }}</td>
                <td> {{ $activity->completed ? "Done" : "Not Done" }}

                    @if( ! $activity->completed)
                        @if( $activity->assigned_user_id == Auth::user()->id  )
                            <form style="display: inline;" action="{{ url('/bugs/inlineUpdate') }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <input type="hidden" value="{{ $activity->id }}" name="id">
                                <input type="hidden" name="completed" value="true">
                                <input type="submit" value="I'm Done" class="btn btn-sm btn-success">
                            </form>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>


</div>
<br>
