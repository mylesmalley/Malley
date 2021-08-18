@extends('syspro::template')

@section('content')
    <h1>New Purchase Request</h1>

    <form class="form"
          method="POST"
          action="{{ url('/syspro/purchasing/newRequest') }}">

        <input type="hidden"
               name="user_id"
               id="user_id"
               value="{{ Auth::user()->id }}">

        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-4">
        <div class="form-group">
            <label for="part_number">Part Number</label>
            <input type="text"
                   class="form-control"
                   id="part_number"
                   value="{{ old('part_number') ?? $part->StockCode ?? "" }}"
                   name="part_number"
                   aria-describedby="parthelp">
            <small id="parthelp"
                   class="form-text text-muted">
                If you know it. Will try to search Syspro for you as well. If it isn't in Syspro but you know the supplier's code, use it here too.</small>
        </div>
            </div>
            <div class="col-md-6">
                <label>Syspro Results</label>
                <div class="list-group"  id="searchResults"  ></div>
            </div>

        </div>

        <br />
            <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text"
                       class="form-control"
                       id="description"
                       name="description"
                       value="{{ old('description')  ??  $part->Description ?? "" }}"
                       required
                       aria-describedby="deschelp">
                <small id="deschelp"
                       class="form-text text-muted">
                    Be as clear as possible if no part number available if Syspro didn't have a match.</small>
            </div>
            </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="supplier_name">Supplier</label>
                        <input type="text"
                               class="form-control"
                               id="supplier_name"
                               name="supplier_name"
                               value="{{ old('supplier_name') ?? $part->Supplier ?? "" }}"
                               required
                               aria-describedby="suphelp">
                        <small id="suphelp"
                               class="form-text text-muted">
                            Supplier Code or name if not known.</small>
                    </div>
                </div>

        </div>
        <br />

        <div class="row">
            <div class="col-md-3">
                <label for="quantity">Quantity Needed</label>
                <input type="text"
                       class="form-control"
                       id="quantity"
                       name="quantity"
                       value="{{ old('quantity') ?? 1 }}"
                       required
                       aria-describedby="quantity">
            </div>
            <div class="col-md-2">
                <label for="unit_of_measure">Unit of Measure</label>
                <input type="text"
                       class="form-control"
                       id="unit_of_measure"
                       name="unit_of_measure"
                       value="{{ old('unit_of_measure') ?? $part->UoM ?? "EA" }}"
                       required
                       aria-describedby="unit_of_measure">
            </div>

            <div class="col-md-4">
                <label for="job">Needed for Job</label>
                <input type="text"
                       class="form-control"
                       id="job"
                       name="job"
                       value="{{ old('job') ?? "" }}"
                       aria-describedby="job">
                <small id="deschelp"
                       class="form-text text-muted">
                    If for R&D put that. If for floor stock put that etc. </small>
            </div>
        </div>
        <br />

        <div class="row">
            <div class="col-md-5">
                <label for="stock">Should We Stock This Part?</label>

                <select name="stock" id="stock" class="form-control">
                    @foreach([0=>"Don't stock", 1=>"Stock this part"] as $k => $v)
                        <option value="{{ $k }}"
                            {{ old('stock') === $k ? 'selected' : '' }}
                        >{{ $v }}</option>
                    @endforeach
                </select>


            </div>
        </div>
        <br>


        <div class="row">
            <div class="col-md-5">
                <label for="urgency">Urgency</label>

                <select name="urgency" id="urgency" class="form-control">
                    @foreach(\App\Models\PurchaseRequest::urgencies() as $k => $v)
                        <option value="{{ $k }}"
                            {{ old('urgency') === $k ? 'selected' : '' }}
                            {{ !old('urgency') && $k === 5 ? 'selected' : '' }}

                        >{{ $v }}</option>
                        @endforeach
                </select>


            </div>
        </div>
        <br />

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">

                    <label for="notes">Notes</label>
                    <textarea
                              rows="4"
                              cols="30"
                              id="notes"
                              name="notes"
                              class="form-control"
                    >{{ old('notes') ?? "" }}</textarea>
                    <small id="deschelp"
                           class="form-text text-muted">
                        Provide any other details you can.</small>
                </div>
            </div>
        </div>
 <br />
        <div class="row">
            <div class="col-2">

            <input type="submit" name="submit" class="btn btn-lg btn-primary" value="Save">
            </div>

            <div class="col">

            <input type="submit" name="submit" class="btn btn-lg btn-primary" value="Save And Add Another">
            </div>

        </div>
        <br /><br /><br />
        <div class="row">
            <div class="col">
            <a href="{{ "/syspro/purchasing/openRequests" }}" class="btn btn-lg btn-warning">Cancel and Go Back</a>
            </div>
        </div>
        <br /><br />
    </form>

@endsection




@section('scripts')
    <script>
        let box = document.getElementById('part_number');

        let sysproResults = null;


        function fill( id )
        {
            document.getElementById('part_number').value = sysproResults[id].StockCode.trim();
            document.getElementById('description').value = sysproResults[id].Description.trim();
            document.getElementById('unit_of_measure').value = sysproResults[id].StockUom.trim();
            document.getElementById('supplier_name').value = sysproResults[id].Supplier.trim();

            let searchResultsBox = document.getElementById('searchResults');
            searchResultsBox.innerHTML = "";
        }

        box.addEventListener('keyup', function(   ){
            let searchResultsBox = document.getElementById('searchResults');
            searchResultsBox.innerHTML = "";
            let term = box.value;

           if ( box.value.length >= 3 )
           {
               let request = new XMLHttpRequest();
               request.open('GET', ` https://index.malleyindustries.com/syspro/purchasing/search?term=${term}`, true);

               request.onload = function() {
                   if (this.status >= 200 && this.status < 400) {


                       let results =  JSON.parse( this.response );
                       sysproResults = results;
                       for ( let i = 0; i < results.length; i++ )
                       {
                           searchResultsBox.innerHTML += `<a class="sys list-group-item list-group-item-action">${results[i].StockCode.trim()} from ${results[i].Supplier.trim()}<br /><small>${results[i].Description}</small></a>`;
                       }

                       let sysResults = document.getElementsByClassName('sys');
                       for (let x = 0; x < sysResults.length; x++ )
                       {
                           sysResults[x].addEventListener('click', function(){
                               fill( x );
                           });
                       }


                   } else {
                       // We reached our target server, but it returned an error

                   }
               };

               request.onerror = function() {
                   // There was a connection error of some sort
               };

               request.send();


           }
           else
           {
               console.log('too short. keep waiting');

           }
        });
    </script>

@endsection
