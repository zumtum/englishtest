<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <input type="text" v-model="questionTitle">
                <input type="checkbox" id="questions-by-author" v-model="questionAuthor">
                <label for="questions-by-author">Show my questions only</label>
                <ul>
                    <li v-for="question in filteredQuestions" :key="question.slug">
                        <label>
                            <input type="checkbox" v-model="selectedQuestions" :value="question">

                            <span>{{ question.title }}</span>
                            <div>{{ question.description }}</div>
                        </label>
                    </li>
                </ul>
                <ul>
                    <li v-for="(selectedQuestion, index) in selectedQuestions" @click="removeSelectedQuestion(index)">
                        <div>{{ selectedQuestion.title }}</div>
                    </li>
                </ul>
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
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
      }
    },
    data() {
      return {
        // questions: [],
        selectedQuestions: [],
        questionTitle: '',
        questionAuthor: false,
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
        this.selectedQuestions.splice(index, 1);
      }
    },
    computed: {
      filteredQuestions() {
        return this.questions.filter(question => {
          if (this.questionAuthor) {
            return question.created_by === 2 && question.title.match(this.questionTitle);
          }

          return question.title.match(this.questionTitle);
        });
      }
    },
    mounted() {
      console.log('Component mounted.');
    },
  };
</script>
