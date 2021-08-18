<template>
    <MIMain>
        <div class="mermaid" v-html="graph"> </div>
    </MIMain>
</template>

<script>
import MIMain from '../Layouts/MIMain';

export default {
    name: "Graph.vue",
    components: {
        MIMain,
    },
    props: [
        'graph'
    ],
    template: MIMain
}
</script>

<style scoped>

</style>
