/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue').default;
import router from './assets/router.js';
import Vuelidate from 'vuelidate';
import VueAWN from "vue-awesome-notifications";

//-------ckeditor para lo referente a los post, incluyendo subir imagenes en el post
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import { MyUploadAdapter } from "./assets/ckeditor/MyUploadAdapter.js";
import Vue from 'vue';


function MyCustomUploadAdapterPlugin( editor ) {
    editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
        // Configure the URL to the upload script in your back-end here!
        return new MyUploadAdapter( loader );
    };
}

ClassicEditor.create(document.querySelector("#content"),{
    extraPlugins: [ MyCustomUploadAdapterPlugin ],
})
    .then(editor => {})
    .catch(error => {
        console.error(error.stack);
    });
//---------- fin ckedior

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('modal-post', require('./components/PostModalComponent.vue').default);
Vue.component('post-list-generic', require('./components/PostListGenericComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(Vuelidate);
Vue.use(VueAWN);

const app = new Vue({
    el: '#app',
    //render: h => h(App), en caso de tener un componente raiz para todo lo relacionado a vue
    router
});

