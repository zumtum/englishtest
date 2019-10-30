<template>
    <div class="card">
        <h5 class="card-header">Questions selection</h5>
        <div class="card-body">
            <div class="form-group">
                <input type="text" class="form-control" v-model="questionTitle" placeholder="Search by questions"
                       aria-label="Search">
                <input type="checkbox" id="questions-by-author" v-model="questionAuthor">
                <label for="questions-by-author">Show my questions only</label>
            </div>
            <div class="form-group selection-container">
                <table class="table table-borderless table-hover">
                    <thead class="thead-dark">
                    <tr class="d-flex">
                        <th scope="col" class="col-8">Title</th>
                        <th scope="col" class="col-2 text-center">Author</th>
                        <th scope="col" class="col-1 text-center">Scores</th>
                        <th scope="col" class="col-1 text-right">Duration</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="question in filteredQuestions" :key="question.slug" class="d-flex"
                        :class="{ 'table-info': question.active }"
                        @click="addSelectedQuestion(question)">
                        <td class="col-8">
                            <span>{{ question.title }}</span>
                        </td>
                        <td class="col-2 text-center">
                            <span>{{ question.author.name }}</span>
                        </td>
                        <td class="col-1 text-center">
                            <span>{{ question.scores }}</span>
                        </td>
                        <td class="col-1 text-right">
                            <span>{{ question.duration }}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group row total-container text-center" v-show="selectedQuestions.length">
                <div class="offset-md-3 col-md-3 totalLabel">Total Scores
                    <div class="totalValue">{{ totalScores }}</div>
                </div>
                <div class="col-md-3 totalLabel">Total Duration(seconds)
                    <input type="hidden" name="duration" :value="totalDuration">
                    <div class="totalValue">{{ totalDuration }}</div>
                </div>
            </div>
            <div class="form-group assigned-container" v-show="selectedQuestions.length">
                <h5 class="card-title">Assigned questions</h5>
                <table class="table table-borderless table-hover">
                    <thead class="thead-dark">
                    <tr class="d-flex">
                        <th scope="col" class="col-9">Title</th>
                        <th scope="col" class="col-1 text-center">Scores</th>
                        <th scope="col" class="col-1 text-center">Duration</th>
                        <th scope="col" class="col-1 text-right">Remove</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(selectedQuestion, index) in selectedQuestions" :key="selectedQuestion.slug"
                        class="d-flex">
                        <td class="col-9">
                            <input type="hidden" name="questions[]" :value="selectedQuestion.id">
                            <span>{{ selectedQuestion.title }}</span>
                        </td>
                        <td class="col-1 text-center">
                            <span>{{ selectedQuestion.scores }}</span>
                        </td>
                        <td class="col-1 text-center">
                            <span>{{ selectedQuestion.duration }}</span>
                        </td>
                        <td class="col-1 text-right">
                            <button class="btn btn-danger" @click="removeSelectedQuestion(index)">X</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
  import axios from 'axios';

  export default {
    props: {
      questions: {
        type: Array,
        required: true,
      },
      relatedQuestions: {
        type: Array,
        default: function () {
          return [];
        },
      },
      userId: {
        type: Number,
        required: true,
      }
    },
    data() {
      return {
        // questions: [],
        checked: true,
        selectedQuestions: [],
        questionTitle: '',
        questionAuthor: false,
        totalScores: 0,
        totalDuration: 0,
      }
    },
    methods: {
      // getQuestions() {
      //   axios.get('/questions')
      //     .then(response => {
      //       this.questions = response.data.data;
      //     })
      //     .catch(error => console.log(error));
      // },
      removeSelectedQuestion(index) {
        const questionId = this.selectedQuestions[index].id;

        this.selectedQuestions.splice(index, 1);

        this.questions.forEach(question => {
          if (questionId === question.id) {
            question.active = false;
          }
        });

        this.countTotalValues();
      },
      addSelectedQuestion(question) {
        if (!this.hasQuestion(question)) {
          question.active = !question.active;
          this.selectedQuestions.push(question);

          this.countTotalValues();
        }
      },
      hasQuestion(question) {
        let questionIsset = false;

        this.selectedQuestions.forEach(selectedQuestion => {
          if (selectedQuestion.id === question.id) {
            questionIsset = true;
            return false;
          }
        });

        return questionIsset;
      },
      countTotalValues() {
        this.totalScores = 0;
        this.totalDuration = 0;

        this.selectedQuestions.forEach(selectedQuestion => {
          this.totalScores += selectedQuestion.scores;
          this.totalDuration += selectedQuestion.duration;
        })
      },
      initRelatedQuestins() {
        this.selectedQuestions = this.relatedQuestions;
        this.selectedQuestions.forEach(selectedQuestion => {
          let foundQuestion = this.questions.find(question => {
            return question.id === selectedQuestion.id;
          });

          foundQuestion.active = true;
        });

        this.countTotalValues();
      }
    },
    computed: {
      filteredQuestions() {
        return this.questions.filter(question => {
          if (this.questionAuthor) {
            return question.created_by === this.userId && question.title.match(this.questionTitle);
          }

          return question.title.match(this.questionTitle);
        });
      }
    },
    created() {
      this.initRelatedQuestins();
    },
  };
</script>

<style scoped>
    .selection-container tr {
        cursor: pointer;
    }

    .selection-container table.table tbody {
        max-height: 350px;
        overflow-y: auto;
        display: block;
    }

    .totalLabel {
        font-size: 22px;
    }

    .totalValue {
        font-size: 26px;
    }
</style>
