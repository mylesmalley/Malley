<template>




        <div class="card border-primary">


            <form class="form" name="wizardForm" @submit.prevent="submitForm()">
                <Question :question="question" />


                <MICheckbox v-if="question.type === 'checkboxes'"
                           :answers="answers" />

                <MISelect v-if="question.type !== 'checkboxes'" @answered="answer_id.push($event)  "
                           :answers="answers" />


                <div class="card-footer">
                    <button class="btn btn-primary"
                            v-if="answer_id.length  || question.type === 'checkboxes'"
                            type="submit">Submit</button>
                </div>
            </form>

        </div>



</template>

<script>
// import Inertia from '@inertiajs/inertia';
import { Inertia } from '@inertiajs/inertia'
import MICheckbox from "./Form/MICheckbox";
import MISelect from "./Form/MISelect";
import Question from "./Form/Question";
import axios from "axios";

export default {
    name: "MIForm.vue",
    props: [
        'question',
        'answers'
    ],
    emits: [
        'formUpdated'
    ],
    components: {
        MICheckbox,
        MISelect,
        Question,
    },
    methods: {
        updateprogress()
        {
            this.progress = axios.get( "/demo/progress/");
        },

        submitForm() {
            let ctx = this;

            let selected_answers = [].filter.call(
                document.getElementsByName('answer_id[]'),
                (c) => c.checked).map(c => c.value);

            let next_question = null;

            if (selected_answers.length === 0)
            {
                next_question = this.answers[0].next;
            }

            console.log( document.wizardForm.answer_id );
            Inertia.visit("/demo/answer",
                {
                    method: 'post',
                    data: {
                        answer_id:  selected_answers,
                        next_question: next_question,
                    },
                    onSuccess: function () {
                        ctx.answer_id = [];
                        ctx.$emit('formUpdated');
                    }
                }
            );

        }
    },



    data: function() {
        return {
            answer_id: [],
        }
    },



}


</script>

<style scoped>

</style>
