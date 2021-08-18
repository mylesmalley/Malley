<template>
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card  border-primary">
                <div class="card-body bg-secondary text-white">

                    <form class="row g-3 align-items-center">
                        <div class="col-6">
                            <label class="visually-hidden" for="search_term">Search For</label>
                            <div class="input-group">
                                <div class="input-group-text bg-primary text-white">Search for</div>
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

                            <div class="input-group-text bg-primary text-white">In</div>

                                <select class="form-select"

                                        v-model="search_location"
                                        @change="test"
                                        id="search_location">
                                    <option disabled>Choose where to search...</option>
                                    <optgroup label="Vehicles">
                                        <option value="vehicles_by_vin">Vehicles by VIN</option>
                                        <option value="vehicles_by_work_order">Vehicles by Work Order</option>

                                    </optgroup>
                                    <optgroup label="Blueprint">
                                        <option value="blueprint" >Blueprints</option>
                                    </optgroup>
                                    <optgroup label="Inventory">
                                        <option value="inventory" selected>Inventory</option>
                                    </optgroup>
                                    <optgroup label="Photos">
                                        <option value="albums" selected>Photo Albums</option>

                                    </optgroup>
                                </select>
                            </div>
                        </div>




                    </form>
                </div>
                <Results :columns="columns"
                         :rows="rows"
                         :url="url"
                         v-if="rows.length > 0 && search_location !== 'albums' "></Results>
                <AlbumResults :columns="columns"
                         :rows="rows"
                         :url="url"
                         v-if="rows.length > 0 && search_location === 'albums' "></AlbumResults>

            </div>

        </div>
    </div>
</template>

<script>

import Results from './Results';
import AlbumResults from "./AlbumResults";

export default {
    components: { AlbumResults, Results },

    data() {
        return {
            search_term: '',
            search_location: 'blueprint',
            columns: [],
            rows: [],
            url: '',
        };
    },
    methods: {
        test() {
            if ( this.search_term.length > 3)
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
                    vue.rows = response.data.rows;
                    vue.columns = response.data.columns;
                    vue.url = response.data.url;

                }).catch((error)=>{

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
