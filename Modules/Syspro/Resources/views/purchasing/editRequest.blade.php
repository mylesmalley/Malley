@extends('syspro::template')

@section('content')
    <h1>Edit Purchase Request</h1>

        <form
            action="{{ url('syspro/purchasing/'.$order->id.'/delete') }}"
            method="POST"
        >
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="DELETE" class="btn btn-danger">
        </form>

    <form method="POST"
          class="form"
          action="{{ url('syspro/purchasing/'.$order->id.'/editRequest') }}">
        {{ csrf_field() }}

        <table class="table">
            <tbody>
                <tr>
                    <td><label for="part_number">Stock Code</label></td>
                    <td><input type="text"
                               name="part_number"
                               id="part_number"
                               class="form-control"
                               style="width:250px;"
                               value="{{ old('part_number')
                                    ?? $order->part_number ?? "" }}"
                        /></td>
                </tr>
                <tr>
                    <td><label for="supplier_name">Supplier</label></td>
                    <td><input type="text"
                               name="supplier_name"
                               id="supplier_name"
                               class="form-control"
                               style="width:250px;"

                               value="{{ old('supplier_name') ?? $order->supplier_name ?? "" }}"
                        /></td>
                </tr>
                <tr>
                    <td><label for="description">Description</label></td>
                    <td><input type="text"
                               name="description"
                               id="description"
                               class="form-control"
                               style="width:400px;"
                               value="{{ old('description')
                                    ?? $order->description ?? "" }}"
                        /></td>
                </tr>
                <tr>
                    <td>Ordered By</td>
                    <td>{{ $order->user->first_name . ' ' . $order->user->last_name }}</td>
                </tr>
                <tr>
                    <td><label for="job">For Job</label></td>
                    <td><input type="text"
                               name="job"
                               id="job"
                               class="form-control"
                               style="width:250px;"
                               value="{{ old('job')
                                    ?? $order->job ?? "" }}"
                        /></td>
                </tr>

                <tr>
                    <td>Stocking</td>
                    <td>
                        Ignore this if the part is already being stocked.<br>
                        @if ( $order->stock )
                            Requested that we stock this part
                        @elseif ( $order->stock === null )
                            The request didn't specify. Ask {{ $order->user->first_name }} for details.
                        @else
                            Don't stock this part

                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Quantity Needed</td>
                    <td>{{ $order->quantity }}</td>
                </tr>
                <tr>
                    <td>Urgency</td>
                    <td>{{ $order::urgencies()[$order->urgency] }}</td>
                </tr>
                <tr>
                    <td>Requested on</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                </tr>
                <tr>
                    <td><label for="notes">Notes</label></td>
                    <td><textarea id="notes"
                                  name="notes"
                                  style="height:100px;"
                                  cols="40"
                                  class="form-control"
                        >{{ old("notes") ?? $order->notes ?? "" }}</textarea></td>
                </tr>


                <tr>
                    <td><label for="purchase_order">Purchase Order</label></td>
                    <td>
                        <input type="text"
                               name="purchase_order"
                               class="form-control"
                               id="purchase_order"
                               value="{{ old('purchase_order') ?? $order->purchase_order ?? '' }}"
                        >
                    </td>
                </tr>


                <tr>
                    <td><label for="status">Status</label></td>
                    <td>
                        <select id='status'
                                name='status'

                                class="form-control">
                            @foreach($order::statuses()  as $key => $value)
                                <option {{ ( old('status') == $key || $order->status == $key ) ? "selected" : "" }} value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit"
                               value="Save Changes"
                               class="btn btn-lg btn-primary" >
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

@endsection

@section('scripts')
    <script>
        document.getElementById('purchase_order').addEventListener('change', function(){
           document.getElementById('status').value = "10";
        });
    </script>
    @endsection
