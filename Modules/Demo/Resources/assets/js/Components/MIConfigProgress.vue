<template>

    <div class="card border-secondary">
        <div class="card-header bg-secondary text-white">
            <h2 >So far...</h2>
        </div>
        <table class="table table-striped table-hover">
            <tr v-for="prog in progress">
                <td>{{ prog["question"] }}?</td>
                <td>
                    <b>{{ prog["answer"]}}</b>
                </td>
            </tr>
        </table>

        <div class="card-footer">
            <inertia-link
                href="/demo/restart"
                class="btn btn-danger">
                Start Over
            </inertia-link>
        </div>
    </div>

</template>

<script>
export default {
    name: "MIConfigProgress.vue",
    props: [ 'progress' ],
}
</script>

<style scoped>

</style>
