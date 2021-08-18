<template>
    <table class="table table-striped table-sm table-hover">
        <thead>
            <tr>
                <th>Blueprint</th>
                <th>Name</th>
                <th>Creator</th>
                <th>Dealer</th>
            </tr>
        </thead>
        <tbody>
            <tr @click="load(  row.encoded )" :key="row.id"  v-for="row in results">
                <td>B-{{ row.id }}</td>
                <td>{{ row.name }} <br> <span class="text-secondary"> {{ row.platform }}</span></td>
                <td>{{ row.user_name }}</td>
                <td>{{ row.dealer }}</td>
            </tr>
        </tbody>

    </table>

</template>

<script>
export default {
    name: "Blueprint.vue",
    props: {
        results: Array,
    },
    methods: {
        load( encoded )
        {
            window.location.href = "https://blueprint.malleyindustries.com/blueprint/"  + encoded;
        }
    }
}
</script>

<style scoped>

</style>
