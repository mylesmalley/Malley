<template>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Albums</th>
        </tr>
        </thead>
        <tbody>
        <tr  v-for="row in rows">
            <td>
                <a :href="'https://blueprint.malleyindustries.com/albums/'+row.id">
                    {{ row.search_string }}
                </a>
                 <br>
                <img class="photo" v-for="m in row.media" :src="m" alt="thumb" />
            </td>
        </tr>
        </tbody>

    </table>

</template>

<script>
export default {
    name: "AlbumResults.vue",
    props: {
        columns: Object,
        rows: Object,
        url: String,
    },
    methods: {
        load( id )
        {
            // window.location.href = this.url + '/' + id;
        }
    }
}
</script>

<style scoped>
    .photo
    {
        width: 100px;
        padding: 3px;
        margin: 3px;
        border:1px solid black;
    }
</style>
