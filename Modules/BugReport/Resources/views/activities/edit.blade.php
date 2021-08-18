<form name="form"
      action="{{ url("/bugs/{$bug->id}/activities") }}"
      method="POST"
      id="">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <input type="hidden" name="bug_report_id" value="{{ $bug->id }}" >

<table class="table table-striped">
    <thead>
        <tr>
            <th>Sequence</th>
            <th>Title</th>
            <th>Assigned To</th>
            <td>Due Date</td>
{{--            <th>Notes</th>--}}
            <th>Complete</th>
        </tr>
    </thead>
    <tbody>
        @forelse( $activities as $activity )
            <input type="hidden" name="id[]" value="{{ $activity->id }}" >

            <tr>
                <td>
                    <select
                            class="form-control"
                            id="sequence"
                            name="sequence[{{ $activity->id }}]"
                            aria-label="sequqnce">
                        <option value="null"></option>
                        @for( $i = 1; $i <= 10; $i++)
                            <option
                                value="{{ $i }}"
                                {{ $activity->sequence == $i ? 'selected' : '' }}
                            >{{ $i }}</option>
                            @endfor
                    </select>
                </td>

                <td>
                    <input
                           type="text"
                           name="title[{{ $activity->id }}]"
                           class="form-control"
                           placeholder="Rows with empty titles will be deleted."

                           aria-label=""
                           value="{{ $activity->title }}">
                </td>


                <td>
                    <select class="form-control"
                            id='assigned_user_id'
                            aria-label=""
                            name="assigned_user_id[{{ $activity->id }}]">
                        <option value="">Unnasigned</option>
                        @foreach ( $users as  $user )
                            <option
                                {{ $activity->assigned_user_id == $user->id ? 'selected' : '' }}

                                value="{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input
                        type="date"
                        name="due_date[{{ $activity->id }}]"
                        class="form-control"
                        placeholder="Rows with empty titles will be deleted."

                        aria-label=""
                        value="{{ $activity->due_date ?? $bug->due_date ?? "" }}">
                </td>
                <td>
                    <select class="form-control"
                            id='completed'
                            aria-label=""
                            name="completed[{{ $activity->id }}]">
                        @foreach ( [ 0=> 'Not Done', 1=>'Done'] as  $k => $v )
                            <option
                                {{ $activity->completed == $k ? 'selected' : '' }}

                                value="{{ $k }}">{{ $v }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="5">No tasks yet</td>
            </tr>
        @endforelse


       @for( $j = 0; $j < 10; $j++)

    <tr>
        <td>
            <input type="hidden" name="id[]" value="{{ time() + $j }}" >

            <select
                class="form-control"
                name="sequence[{{ time() + $j }}]"
                aria-label="sequqnce">
                <option value=""></option>
                @for( $i = 0; $i <= 10; $i++)
                    <option >{{ $i }}</option>
                @endfor
            </select>
        </td>

        <td>
            <input
                type="text"
                name="title[{{ time() + $j }}]"
                placeholder="Rows with empty titles will be deleted."
                class="form-control"
                aria-label=""
                value="">
        </td>


        <td>
            <select class="form-control"
                    aria-label=""
                    name="assigned_user_id[{{ time() + $j }}]">
                <option value=""></option>
                @foreach ( $users as  $user )
                    <option
                        value="{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <input
                type="date"
                name="due_date[{{ time() + $j }}]"
                class="form-control"
                placeholder="Rows with empty titles will be deleted."

                aria-label=""
                value="{{ $bug->due_date ?? '' }}">
        </td>
        <td>
            <select class="form-control"
                    id='completed'
                    aria-label=""
                    name="completed[{{ time() + $j }}]">
                <option
                    value="0"></option>
                @foreach ( [ 0=> 'Not Done', 1=>'Done'] as  $k => $v )
                    <option
                        value="{{ $k }}">{{ $v }}</option>
                @endforeach
            </select>
        </td>
    </tr>

           @endfor

    </tbody>
</table>
<input type="submit" class="btn btn-primary" value="Save Changes to Activities">
</form>
