<template>
    <div class="card">
        <div class="card-header">
            <h2>Pick Your Name</h2>

            <inertia-link
                class="btn btn-info btn-lg float-right"
                href="/time"
                as="button">  Back
            </inertia-link>
        </div>
        <div class="card-body">

    <br>
        <inertia-link
            class="btn btn-warning btn-lg"
            :href="'/time/keypad/'+s.id"
            as="button"
            method="get"
            :data="{
                id: s.id
            }"
            v-for="s in staff">{{ s.first_name }} {{ s.last_name }}

        </inertia-link>
        </div>
    </div>


</template>

<script>

export default {
    name: "StaffByLetter.vue",
    props: ['staff'],
}
</script>

<style scoped>

</style>
