<template>
    <h1>Root component</h1>

    <input type="text" v-model="blueprint_id">
    <button @click="load()">Load BOM</button>

    <PhantomView
        v-for="phantom in phantoms"
        :phantom="phantom"
        :title=" phantom.option_name " ></PhantomView>
</template>

<script>

import axios from "axios";
import PhantomView from "./PhantomView";


export default {
    name: "App.vue",
    components: { PhantomView },
    data() {
        return {
            blueprint_id: null,
            phantoms: null,
        }
    },
    methods: {
        load() {
            axios.get('/blueprintbom/'+this.blueprint_id, {})
                .then((  response ) => this.phantoms = response.data );
        }
    }

}
</script>

<style scoped>

</style>
