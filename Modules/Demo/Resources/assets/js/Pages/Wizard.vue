<template>
    <MIMain>

        <div class="row">
            <div class="col-6">
                <MIForm :question="question"
                        :answers="answers" />
            </div>


            <div class="col-6">
                <MIConfigProgress
                    @formUpdated="updateProgress"
                    :progress="progress" />

            </div>
        </div>




    </MIMain>
</template>

<script>
import MIMain from '../Layouts/MIMain';
import MIForm from '../Components/MIForm';
import MIConfigProgress from '../Components/MIConfigProgress';
import axios from "axios";

export default {
    name: "Wizard.vue",
    components: {
        MIMain,
        MIForm,
        MIConfigProgress,
    },
    data() {
      return {
          progress: null,
      }
    },
    methods: {
        updateProgress() {
            console.log( 'updated progress details ');

            axios.get('/demo/progress').then(
                resp => {

                    console.log( resp.data) ;
                    this.progress = resp.data ;
                }
            )
        }
    },

    created:  function () {
        this.updateProgress();
    },

    props: [
        'question',
        'answers'
    ],
    template: MIMain
}
</script>

<style scoped>

</style>
