<template>
    <tr>
        <td> <inertia-link v-bind:href="`/time/${ user.id }`"> {{ user.last_name }}</inertia-link></td>
        <td> {{ user.first_name }}</td>
    </tr>

</template>

<script>
import User from './User';

export default {
    name: "name",
    components: 'User',
    props: [
        'user',
    ]
}
</script>

<style scoped>

</style>
