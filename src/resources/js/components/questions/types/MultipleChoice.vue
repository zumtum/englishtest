<template>
    <div>
        <input type="hidden" name="answers" :value="JSON.stringify(answers)">
        <table class="table table-borderless">
            <thead>
                <tr class="d-flex">
                    <th scope="col" class="col-1">#</th>
                    <th scope="col" class="col-9">Answer</th>
                    <th scope="col" class="col-1 text-center">Correct</th>
                    <th scope="col" class="col-1 text-right">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(answer, index) in answers" class="d-flex">
                    <th scope="row" class="col-1">{{ index + 1 }}</th>
                    <td class="col-9">
                        <input type="text" class="form-control" v-model="answer.text">
                    </td>
                    <td class="col-1 text-center">
                        <input type="checkbox" v-model="answer.correct">
                    </td>
                    <td class="col-1 text-right">
                        <button class="btn btn-danger" @click.prevent="removeAnswer(index)">X</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-success float-right" @click.prevent="addAnswer">Add answer</button>
    </div>
</template>

<script>
  export default {
    props: ['relatedAnswers'],
    methods: {
      addAnswer() {
        this.answers.push({
          text: '',
          correct: false,
        });
      },
      removeAnswer(index) {
        if (this.answers.length > 1) {
          this.answers.splice(index, 1);
        }
      },
    },
    data() {
      return {
        answers: [],
      }
    },
    created() {
      if (this.relatedAnswers.length === 0) {
        this.addAnswer();
      } else {
          this.answers = this.relatedAnswers;
      }
    }
  }
</script>

<style scoped>

</style>