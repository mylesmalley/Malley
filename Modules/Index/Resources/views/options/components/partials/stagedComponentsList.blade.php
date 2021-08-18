<div class="card">
    <div class="card-header">
        Staged Components for {{ $option->option_name }}
    </div>
    <table class="table table-sm table-striped">
        <thead>
        <tr>
            <th>Stock Code</th>
            <th>Description</th>
            <th>QTY</th>
            <th>UOM</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @forelse( $components as $c )
            <tr>
                <td>{{ trim( $c->component_stock_code ) ?? "NA" }}</td>
                <td>{{ trim( $c->component_description ) ?? "NA" }}</td>
                <td>{{ (float) $c->component_material_qty ?? 0 }}</td>
                <td>{{ trim( $c->component_unit_of_measure ) ?? 'EA' }}</td>
                <td>
                    <form class="row"
                          method="POST"
                          action="{{ url("/index/option/{$option->id}/components") }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <input type="hidden" name="component_id" value="{{ $c->id }}">
                        <input type="submit"
                               class="btn btn-sm btn-danger"
                               value="x">

                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    No components needed for this option
                </td>
            </tr>
        @endforelse
        </tbody>

    </table>
    <small>These components are staged for the option and can be changed or removed without affecting Syspro. When you post changes to Syspro, the list will be the bill of materials for the new revision. </small>
</div>
