/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// Import Vue 3
import { createApp } from 'vue';

// Import your component
import ExampleComponent from './components/ExampleComponent.vue';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Create the app and mount it to the DOM
const app = createApp({});
app.component('example-component', ExampleComponent);

// Mount the Vue app to the DOM element with id 'app'
app.mount('#app');

console.log('Hello World from App.js');