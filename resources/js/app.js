
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('questions', require('./components/QuestionsSelect.vue').default);
import QuestionsSelect from './components/questions/QuestionsSelect';
import QuestionTypes from './components/questions/types/QuestionTypes';
import EmailsSelect from './components/assignments/EmailsSelect';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//   EL: '#APP',
//   render: h => h(Questions),
// });

import axios from 'axios';

// axios.defaults.baseURL = 'http://api.englishtest-backend.loc:8088/v1';

new Vue({
  el: '#app',
  components: {
    'questions-select': QuestionsSelect,
    'question-types': QuestionTypes,
    'emails-select': EmailsSelect,
  },
  // render: h => h(Questions)
});
