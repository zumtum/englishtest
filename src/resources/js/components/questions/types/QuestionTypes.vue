<template>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="form-group">
                <label>Question type</label>
                <select class="form-control" name="type_slug" v-model="selectedType">
                    <option v-for="type in types" :value="type.slug" :key="type.slug">{{ type.name }}</option>
                </select>
            </div>
            <component :is="switchTypes"></component>
        </div>
    </div>
</template>

<script>
  import MultipleChoice from './MultipleChoice';
  import MissingWords from './MissingWords';

  export default {
    props: {
      types: {
        type: Array,
        required: true,
      },
    },
    components: {
      'multiple-choice': MultipleChoice,
      'missing-words': MissingWords,
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
    mounted() {
      this.selectedType = this.types[0].slug;
    }
  }
</script>

<style scoped>

</style>