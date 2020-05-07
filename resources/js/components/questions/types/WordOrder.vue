<template>
    <div>
        <input type="hidden" name="answers" :value="JSON.stringify(answer)">
        <div class="form-group">
            <label>Answer</label>
            <input type="text" class="form-control" v-model="answer[0].text" required>
        </div>
    </div>
</template>

<script>
  export default {
    props: ['relatedAnswers'],
    data() {
      return {
        answer: [{
          text: '',
          correct: true,
        }],
      }
    },
    created() {
      if (this.relatedAnswers.length > 0) {
        this.answer = this.relatedAnswers;
      }
    }
  }
</script>

<style scoped>

</style>