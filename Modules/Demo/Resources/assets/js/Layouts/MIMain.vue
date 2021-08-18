<template>
    <main>

        <div class="container">
            <h1>Transit Config Demo 2</h1>
            <slot />
        </div>

    </main>
</template>

<script>
import MIConfigProgress from "../Components/MIConfigProgress";

export default {
    components: {
        MIConfigProgress
    },
    name: "MIMain.vue"
}
</script>

<style scoped>

</style>
