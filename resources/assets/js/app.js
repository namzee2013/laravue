
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import router from './routes.js'
require('./bootstrap.js')
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('logout', require('./components/auth/Logout.vue'));
Vue.component('employee-info', require('./components/auth/EmployeeInfo.vue'));
Vue.component('menu-left', require('./components/MenuLeft.vue'));
Vue.component('login', require('./components/auth/Login.vue'));
Vue.component('ckeditor', require('./components/Ckeditor.vue'));
const app = new Vue({
  el: '#app',
  data:{
    authenticated: '',
    role: '',
  },
  mounted: function mounted() {
    //do something after mounting vue instance
    this.authenticated = sessionStorage.getItem('authenticated');
    this.role = sessionStorage.getItem('role');
  },
  router,
});
