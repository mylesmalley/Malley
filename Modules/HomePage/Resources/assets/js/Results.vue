<template>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th v-for="c in columns">{{ c }}</th>
            </tr>
        </thead>
        <tbody>
            <tr @click="load( row.id, row.encoded )"  v-for="row in rows">
                <td v-for="(val, column_key ) in columns">{{ row[ column_key ] }}</td>
            </tr>
        </tbody>

    </table>

</template>

<script>
export default {
    name: "Results.vue",
    props: {
        columns: Object,
        rows: Object,
        url: String,
    },
    methods: {
        load( id, encoded )
        {
            if ( encoded )
            {
                window.location.href = this.url  + encoded;
            }
            else
            {
                window.location.href = this.url  + id;
            }
        }
    }
}
</script>

<style scoped>

</style>
