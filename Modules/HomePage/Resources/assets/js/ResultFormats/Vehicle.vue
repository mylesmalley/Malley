<template>
    <table class="table table-striped table-sm table-hover">
        <thead>
            <tr>
                <th>Reference</th>
                <th>Work Order(s)</th>
                <th>Details</th>
                <th>OEM Dealer</th>
                <th>Customer</th>
            </tr>
        </thead>
        <tbody>
            <tr @click="load( row.id  )"  v-for="row in results" :key="row.id">
                <td>{{ row.identifier }}</td>
                <td>{{ row.work_order }}</td>
                <td>{{ row.vin }} <br> <span class="text-secondary"> {{ row.make }} {{ row.model }} {{ row.year }}</span></td>
                <td>{{ row.oem_dealer }}</td>
                <td>{{ row.customer_name }}</td>
<!--                <td>{{ row.user_name }}</td>-->
<!--                <td>{{ row.dealer }}</td>-->
            </tr>
        </tbody>

    </table>

</template>

<script>
export default {
    name: "Vehicle.vue",
    props: {
        results: Array,
    },
    methods: {
        load(  id )
        {
            window.location.href = "https://index.malleyindustries.com/vehicles/" + id  ;
        }
    }
}
</script>

<style scoped>

</style>
