<template>
    {{ user.first_name }} <br>
    {{ user.email }} <br>

</template>

<script>
export default {
    name: "User.vue",
    props: ['user']
}
</script>

<style scoped>

</style>
