<template>
    <div class="card-header bg-primary text-white">
        <h2>{{ question.text }}   </h2>
        <small class="text-secondary">{{ question.id}}</small>
    </div>

</template>

<script>
export default {
    name: "Question.vue",
    props: [
        'question',
    ]
}
</script>

<style scoped>

</style>
