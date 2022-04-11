<div class="card border-secondary m-1">
    <div class="card-header text-center bg-secondary text-white">
        <h6>Choose a Job</h6>
    </div>
    <div class="card-body">

                <button class="btn btn-sm btn-outline-primary {{ ( 'RECENT' === $selectedTab) ? 'active' : '' }} text-sm "
                        wire:click="clickTabRecent"
                        dusk="clickTabRecent"
                >RECENT</button>

                <button class="btn btn-sm btn-outline-primary {{ ( 'SEARCH' === $selectedTab) ? 'active' : '' }} "
                        wire:click="clickTabSearch"
                        dusk="clickTabSearch"
                >SEARCH &nbsp;
                    <img src="data:image/gif;base64,R0lGODlhMwAzAPABAAAAAAAAACH/C0ltYWdlTWFnaWNrDmdhbW1hPTAuNDU0NTQ1ACH5BAUAAAEALAAAAAAzADMAAAK9jI9pwN0Ko5Su2olzsPzqv3RiBWbj6ZTUeaCqImLxG3paR3O5/en0xjORfrVHb0gsMo6ppBJwQzqBzUkweYVVp0qZlJttfafhLjcxRqTJW63xLH5D1k46dQmP4yPlX7+/04ZmF7i3Iscm6IaIRXhn2Kg45xglucioAjhIyae5aWnl+Ql6Sdrp44VTiKrHsooCC1kSSysLUjuk6lc7ipk5csiZ92Q7fCo8rGucarpM7FzZ7MwKfVxcrSYNbVQAADs="
                         style="width:14px;"
                         alt="" >
                </button>
            @foreach( $prefixes as $prefix )


                    <button class="btn btn-sm btn-outline-primary  {{ ( $prefix === $selectedTab) ? 'active' : '' }} "
                            wire:click="clickTab('{{ $prefix }}')"
                            dusk="clickTab{{ $prefix }}"
                    >{{ trim( $prefix, '0') }}</button>
            @endforeach
        @if ( $searchMode )
            <div id="searchForm" class="card border-secondary bg-secondary text-white">
                <div class="card-body">
                    <form wire:submit.prevent="">
                        <div class="col-12">
                            <label class="visually-hidden" for="searchterm">Search Jobs</label>
                            <div class="input-group">
                                <div class="input-group-text">Start typing to search for a job:</div>
                                <input id="searchterm"
                                       class="form-control"
                                       type="search"
                                       autofocus
                                       wire:model.debounce.500ms="searchTerm"
                                       wire:keyup="submitSearch">
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        @endif
    </div>

    <table class="table table-striped table-hover table-sm">
        <thead>
        <tr>
            <th>Job</th>
            <th>Description</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse( $results as $r )
            <!-- Search result -->
            @if ( is_object( $r ) )
                <tr>
                    <td>{{ $r->Job ?? 'Job Number' }}</td>
                    <td>{{ $r->JobDescription ?? "description" }}</td>
                    <td class="text-end">

                        <form action="{{ route('labour.clock_in') }}" method="POST">
                            @csrf
                            <input type="hidden" name="job" id="job" value="{{ $r->Job }}">
                            <button type="submit"
                                    id="startJob{{ $r->Job }}"
                                    dusk="startJob{{ $r->Job }}"
                                    class="btn btn-sm btn-outline-primary"> Start on {{ $r->Job }}</button>
                        </form>
                    </td>
                </tr>
            @endif

        @empty
            <tr>
                <td dusk="no-jobs-found" colspan="3" class="text-center">
                    No jobs found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

