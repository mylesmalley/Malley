<template>
    <h1>logged in! Hello, {{ user.first_name }}</h1>
</template>

<script>
export default {
    name: "LoggedIn.vue",
    props: {
        user: Object,
    }
}
</script>

<style scoped>

</style>
