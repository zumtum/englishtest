<template>
    <div>
        <input type="hidden" name="answers" :value="JSON.stringify(answers)">
        <table class="table table-borderless">
            <thead>
                <tr class="d-flex">
                    <th scope="col" class="col-1">#</th>
                    <th scope="col" class="col-5">Phrase</th>
                    <th scope="col" class="col-5">Match</th>
                    <th scope="col" class="col-1 text-right">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(match, index) in matches" class="d-flex">
                    <th scope="row" class="col-1">{{ index + 1 }}</th>
                    <td class="col-5">
                        <input type="text" class="form-control" v-model="match.phrase" @change="generateAnswerText(index)" required>
                    </td>
                    <td class="col-5">
                        <input type="text" class="form-control" v-model="match.matchPhrase" @change="generateAnswerText(index)" required>
                    </td>
                    <td class="col-1 text-right">
                        <button class="btn btn-danger" @click.prevent="removeMatchPhrase(index)">X</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-success float-right" @click.prevent="addMatchPhrase">Add match</button>
    </div>
</template>

<script>
  export default {
    props: ['relatedAnswers'],
    methods: {
      addAnswer(answerText) {
        this.answers.push({
          text: answerText,
          correct: true,
        });
      },
      removeAnswer(index) {
        if (this.answers.length > 1) {
          this.answers.splice(index, 1);
        }
      },
      addMatchPhrase() {
        this.matches.push({
          phrase: '',
          matchPhrase: '',
        });

        this.addAnswer('');
      },
      removeMatchPhrase(index) {
        if (this.matches.length > 1) {
          this.matches.splice(index, 1);
          this.removeAnswer(index);
        }
      },
      generateAnswerText(index) {
        this.answers[index].text = this.matches[index].phrase
          + this.phraseSeparator
          + this.matches[index].matchPhrase;
      }
    },
    computed: {

    },
    data() {
      return {
        answers: [],
        matches: [],
        phraseSeparator: ' >> ',
      }
    },
    created() {
      if (this.relatedAnswers.length === 0) {
        this.addMatchPhrase();
      } else {
        this.answers = this.relatedAnswers;

        this.matches = this.relatedAnswers.map(answer => {
          const separatedAnswers = answer.text.split(this.phraseSeparator);

          return {
            phrase: separatedAnswers[0],
            matchPhrase: separatedAnswers[1],
          };
        });
      }
    }
  }
</script>

<style scoped>

</style>