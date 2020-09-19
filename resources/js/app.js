/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'

Vue.use(VueRouter)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('navigation', require('./components/navigation.vue').default);
Vue.component('chat-nav', require('./components/nav-chat.vue').default);
Vue.component('cart-nav', require('./components/cart-nav.vue').default);
Vue.component('chat-box-component', require('./components/chat/ChatBoxComponent.vue').default);
Vue.component('chat-user-list-component', require('./components/chat/ChatUserListComponent.vue').default);
Vue.component('chat-form-component', require('./components/chat/ChatFormComponent.vue').default);
Vue.component('chat-message-component', require('./components/chat/ChatMessageComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
