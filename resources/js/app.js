/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import laravelEchoServer from '../../laravel-echo-server.json'
require('./bootstrap');

window.Vue = require('vue').default;
import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('chat-layout', require('./components/ChatLayout.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        currentUserLogin: null,
        echoCredentials: {
            appId: laravelEchoServer.clients[0].appId,
            key: laravelEchoServer.clients[0].key
        }
    },
    created() {
        this.getCurrentUserLogin()
    },
    methods: {
        async getCurrentUserLogin() {
            try {
                const res = await axios.get('/chats/getUserLogin')
                this.currentUserLogin = res.data
            } catch (e) {
                console.log(e)
            }
        }
    }

});
