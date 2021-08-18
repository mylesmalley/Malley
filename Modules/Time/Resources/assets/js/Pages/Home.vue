<template>

    <div class="card">
        <div class="card-header">
            <h1> Hello, {{ user.first_name }} </h1>
            <inertia-link href="/time/logout" class="btn btn-success">Log Out</inertia-link>
        </div>
        <div class="card-body">
            <button
                @click="fetch( p )"
                class="btn btn-info btn-lg"
                href="#" v-for="p in prefixes">
                {{ p }}</button>


            <hr>

            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>Job</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>

                <tr v-for="j in jobs">
                    <td>{{ j.Job}}</td>
                    <td>{{ j.JobDescription }}</td>
                    <td>
                        <button
                            class="btn btn-success"
                            @click.prevent="clockIn( j.Job )">
                            Select
                        </button>
                    </td>
                </tr>
                </tbody>

            </table>
        </div>
    </div>

</template>

<script>
const axios = require('axios');

export default {
    name: "LoggedIn.vue",
    data() {
        return {
            jobs: [],
        }
    },
    props: {
        user: Object,
        prefixes: Object,
    },
    methods:
        {
            fetch( p )
            {
                let tmp = this;

                axios.get( '/time/fetchAvailableJobs/'+p)
                    .then( function(response) {
                        tmp.jobs = response.data;
                    })
            },
            clockIn( job )
            {
                let vue = this;
                axios.post( '/time/clockIn', {
                    user: vue.user.id,
                    job: job,
                }).then( () => window.location.href = "/time/home" );
            }


        }
}
</script>

<style scoped>

</style>
