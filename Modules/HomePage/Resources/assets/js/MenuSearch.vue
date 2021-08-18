<template>

    <div class="card bg-white">
        <div class="card-header bg-primary">
                    <form class="row g-3 align-items-center">
                        <div class="col-6">
                            <label class="visually-hidden" for="search_term">Search For</label>
                            <div class="input-group">
                                <div class="input-group-text bg-dark text-white">Search for</div>
                                <input type="text" class="form-control"
                                       @keyup="test"
                                       id="search_term"
                                       v-model="search_term"
                                       placeholder="start typing in what you want to look for">
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="visually-hidden"
                                   for="search_location">Search Location</label>
                            <div class="input-group">

                            <div class="input-group-text bg-dark text-white">In</div>

                                <select class="form-select"

                                        v-model="search_location"
                                        @change="test"
                                        id="search_location">
                                    <option disabled>Choose where to search...</option>
                                        <option value="vehicles2">Vehicles</option>
                                        <option value="blueprint2" >Blueprints</option>
<!--                                    </optgroup>-->
<!--                                    <optgroup label="Inventory">-->
<!--                                        <option value="inventory" selected>Inventory</option>-->
<!--                                    </optgroup>-->
<!--                                    <optgroup label="Photos">-->
<!--                                        <option value="albums" selected>Photo Albums</option>-->

<!--                                    </optgroup>-->
                                </select>
                            </div>
                        </div>




                    </form>

    </div>


    <Blueprint
         :results="rows"
         v-if="search_location === 'blueprint2' && rows.length > 0 " />


        <Vehicle
            :results="rows"
            v-if="search_location === 'vehicles2' && rows.length > 0 " />


        <div class="text-primary text-center" v-if=" rows.length === 0">No results yet. Start typing...</div>



</div>

</template>

<script>

import AlbumResults from "./AlbumResults";
import Blueprint from "./ResultFormats/Blueprint";
import Vehicle from "./ResultFormats/Vehicle";

export default {
    components: { AlbumResults,
        Blueprint,
        Vehicle
    },

    data() {
        return {
            search_term: '',
            search_location: 'blueprint2',
        //    columns: [],
            rows: [],
          //  url: '',
        };
    },
    created() {
        if (window.location.href.indexOf("vehicle") > -1) {
            this.search_location = 'vehicles2';
        }
        else
        {
            this.search_location = 'blueprint2';
        }
    },
    methods: {
        test() {
            this.rows = [];
            if ( this.search_term.length > 2)
            {
                let vue = this;

                axios({
                    method: 'post',
                    url: "/search",
                    data: {
                        search_term: vue.search_term,
                         search_location: vue.search_location,
                    },
                }) .then((response)=>{
                    vue.rows = response.data.hits;

                }).catch((error)=>{
                    console.warn("problem searching")
                });


            }
        }
    }
};
</script>

<style scoped>
p {
    font-size: 2em;
    text-align: center;
}
</style>
