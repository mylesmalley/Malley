<template>
    <div class="card">
        <div class="card-header" >
            <h2>{{ title }} {{ phantom.option_description}}</h2>
            <div class="float-right" ><button @click="toggle" class="btn btn-dark">Expand</button></div>
        </div>
        <table v-if="visible" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Stock Code</th>
                    <th>Description</th>
                    <th>QTY</th>
                    <th>UOM</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="c in phantom.components">
                    <td>{{ c.component_stock_code }}</td>
                    <td>{{ c.component_description }}</td>
                    <td>{{ c.component_material_qty }}</td>
                    <td>{{ c.component_unit_of_measure }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    name: "PhantomView.vue",
    data() {
        return {
            visible: false,
        }
    },
    props: {
        title: String,
        phantom: Object,
    },
    methods: {
        toggle() {
            console.log( `toggle visibility on ${this.title} `);
            this.visible = ! this.visible;
        }
    }
}
</script>

<style scoped>

</style>
