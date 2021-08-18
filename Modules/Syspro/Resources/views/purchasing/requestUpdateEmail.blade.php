<h1>Purchase request update</h1>
<p>
    Your request for {{ $req->quantity }} {{ $req->unit_of_measure }} of <b>{{ $req->part_number }} "{{ $req->description }}" </b> has been updated by Purchasing.
</p>

<table>
    <tbody>
        <tr>
            <td>Status</td>
            <td>{{ \App\Models\PurchaseRequest::statuses()[  $req->status ] }}</td>
        </tr>
        <tr>
            <td>Notes</td>
            <td>{{ $req->notes }}</td>
        </tr>
    </tbody>
</table>

<ul>
    <li><a href="http://index.malleyindustries.com/syspro/purchasing/openRequests">See what else has been requested.</a></li>
    <li><a href="http://index.malleyindustries.com/syspro/purchasing/newRequest">Request another part.</a></li>
</ul>
