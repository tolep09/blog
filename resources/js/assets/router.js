window.Vue = require('vue').default;

import VueRouter from 'vue-router';

import PostListComponent from '../components/PostListComponent.vue';
import PostDetailComponent from '../components/PostDetailComponent.vue';
import PostCategoryComponent from '../components/PostCategoryComponent.vue';

import ContactComponent from '../components/ContactComponent.vue';
import CategoryListComponent from '../components/CategoryListComponent.vue';

import Vue from 'vue';

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    routes: [
        { path: '/', component: PostListComponent, name: 'list' },
        { path: '/post/:id', component: PostDetailComponent, name: 'post-detail' },
        { path: '/post-category/:category_id', component: PostCategoryComponent, name: 'posts-category' },
        { path: '/contact', component: ContactComponent, name: 'contact' },
        { path: '/categories', component: CategoryListComponent, name: 'categories' }
      ]
});