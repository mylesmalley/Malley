<template>

    <div class="card">
        <div class="card-header">
            <h2>First Letter of Your Last Name</h2>
        </div>
        <div class="card-body">
            <inertia-link
                class="btn btn-lg btn-primary"
                type="button"
                as="button"
                method="get"
                :href="'/time/letter/'+ l "
                :data="{ letter: l }"
                v-for="l in 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('')">{{ l }}</inertia-link>
        </div>
    </div>


</template>

<script>
//    import Login from '../Layouts/Login'

    export default {
   //     components: { Login },
        data() {
            return {
                msg: " as df ",
            }
        }
    }
</script>

<style>

</style>
