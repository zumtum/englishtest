<template>
    <div>
        <input type="hidden" name="answers" :value="JSON.stringify(answer)">
        <div class="form-group">
            <label>Answer</label>
            <input type="text" class="form-control" v-model="splitWords" required>
        </div>
        <div class="form-group">
            <span
                class="missing-word badge badge-success"
                v-for="(phraseWord, index) in modifiedAnserWords" @click="triggerWord(index)"
            >{{ phraseWord }}</span>
            <small class="form-text text-muted" v-show="answerText">Please click on a word to hide or show it.</small>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        answer: [{
          text: '',
          correct: true,
        }],
        answerText: '',
        hideText: '...',
        phraseSeparator: ' >> ',
        defaultAnswerWords: [],
        modifiedAnserWords: [],
      }
    },
    methods: {
      triggerWord(index) {
        if (this.modifiedAnserWords[index] === this.hideText) {
          this.modifiedAnserWords.splice(index, 1, this.defaultAnswerWords[index]);
        } else {
          this.modifiedAnserWords.splice(index, 1, this.hideText);
        }

        this.generateResultAnswer();
      },
      generateResultAnswer() {
        this.answer[0].text = this.answerText
          ? this.answerText + this.phraseSeparator + this.modifiedAnserWords.join(' ')
          : '';
      }
    },
    computed: {
      splitWords: {
        set: function(text) {
          this.answerText = text;
          this.defaultAnswerWords = text.split(' ');
          this.modifiedAnserWords = [...this.defaultAnswerWords];
          this.generateResultAnswer();
        },
        get: function() {
          return this.answerText
        }
      },
    },
    created() {
      this.generateResultAnswer();
    }
  }
</script>

<style scoped>
    span.missing-word {
        font-size: 17px;
        margin-right: 5px;
        cursor: pointer;
    }
</style>