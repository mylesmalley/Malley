<div id="top-menu" class="syspro-menu">

    <form method="post" action="{{ url("/syspro/inventoryQuery" ) }}">
        {{ csrf_field() }}

        LOOK UP<input type="text" value="{{ $query }}" name="term" />
        <input type="submit" value="GO">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="syspro-button-yellow" href="/syspro/inventoryQuery/search">SEARCH PART NUMBERS</a>

    </form>
</div>
