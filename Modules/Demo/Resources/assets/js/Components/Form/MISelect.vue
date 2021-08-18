<template>

    <div class="card-body">
        <div class="form-check"  v-for="answer in answers" >
            <input class="form-check-input"
                   :value="answer.id"
                   type="radio"
                   @click="$emit('answered', answer.id)"
                   name="answer_id[]"
                   :id="'answer_id'+answer.id">
            <label class="form-check-label"  :for="'answer_id'+answer.id">
                {{ answer.text }}  <small class="text-secondary">{{ answer.id }}</small>
            </label>
        </div>

    </div>
</template>

<script>
export default {
    name: "MISelect.vue",
    emits: ['answered'],
    props: [
        'answers',
    ]
}
</script>

<style scoped>

</style>
