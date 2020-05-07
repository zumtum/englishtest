<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-group">
                <label>Question type</label>
                <select class="form-control" name="type_slug" v-model="selectedType">
                    <option v-for="type in allTypes" :value="type.slug" :key="type.slug">{{ type.name }}</option>
                </select>
            </div>
            <component :is="switchTypes" :related-answers="answers"></component>
        </div>
    </div>
</template>

<script>
  import MultipleChoice from './MultipleChoice';
  import MissingWords from './MissingWords';
  import WordOrder from './WordOrder';
  import MatchPhrases from './MatchPhrases';

  export default {
    props: {
      allTypes: {
        type: Array,
        default: function () {
          return [];
        },
      },
      relatedType: {
        type: String,
        default: '',
      },
      answers: {
        type: Array,
        default: function () {
          return [];
        },
      },
    },
    components: {
      'multiple-choice': MultipleChoice,
      'missing-words': MissingWords,
      'word-order': WordOrder,
      'match': MatchPhrases,
    },
    computed: {
      switchTypes() {
        return this.selectedType.replace('_', '-');
      }
    },
    data() {
      return {
        selectedType: '',
      }
    },
    created() {
      this.selectedType = this.relatedType || this.allTypes[0].slug;
    }
  }
</script>

<style scoped>

</style>