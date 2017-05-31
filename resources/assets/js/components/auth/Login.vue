<template>
  <div class="login" v-if="!this.$root.authenticated">
    <div class="form-signin">
      <div class="text-center">
          <img src="public/assets/img/logo.png" alt="Metis Logo">
      </div>
      <hr>
      <div class="tab-content">
        <div id="login" class="tab-pane active">
          <form @submit.prevent="login">
              <p class="text-muted text-center">
                  Enter your username and password
              </p>
              <input type="text" placeholder="Username" class="form-control top" v-model="employee.username">
              <span class="text-danger">{{errors.username ? errors.username[0] : ''}}</span>

              <input type="password" placeholder="Password" class="form-control bottom" v-model="employee.password">
              <span class="text-danger">{{errors.password ? errors.password[0] : ''}}</span>
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
          </form>
        </div>
        <div id="forgot" class="tab-pane">
          <form action="index.html">
              <p class="text-muted text-center">Enter your valid e-mail</p>
              <input type="email" placeholder="mail@domain.com" class="form-control">
              <br>
              <button class="btn btn-lg btn-danger btn-block" type="submit">Recover Password</button>
          </form>
        </div>
        <div id="signup" class="tab-pane">
          <form @submit.prevent="register">
              <input type="text" placeholder="username" class="form-control top" v-model="employeeRegister.username">
              <input type="password" placeholder="password" class="form-control middle" v-model="employeeRegister.password">
              <input type="text" placeholder="fullname" class="form-control middle" v-model="employeeRegister.fullname">
              <input type="text" placeholder="avatar" class="form-control middle" v-model="employeeRegister.avatar">
              <input type="text" placeholder="birthday" class="form-control middle" v-model="employeeRegister.birthday">
              <input type="text" placeholder="gender" class="form-control middle" v-model="employeeRegister.gender">
              <input type="text" placeholder="address" class="form-control middle" v-model="employeeRegister.address">
              <input type="text" placeholder="phone" class="form-control middle" v-model="employeeRegister.phone">
              <input type="text" placeholder="role" class="form-control bottom" v-model="employeeRegister.role_id">
              <button class="btn btn-lg btn-success btn-block" type="submit">Register</button>
          </form>
        </div>
      </div>
      <hr>
      <div class="text-center">
        <ul class="list-inline">
            <li><a class="text-muted" href="#login" data-toggle="tab">Login</a></li>
            <li><a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a></li>
            <li><a class="text-muted" href="#signup" data-toggle="tab">Signup</a></li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: function(){
    return {
      employee: {
        username: '',
        password: ''
      },
      employeeRegister: {
        username: '',
        password: '123456',
        fullname: 'Thanh Nam',
        avatar: 'avatar.png',
        birthday: '1995/03/27',
        gender: 'male',
        address: 'K325/46 Hung Vuong',
        phone: '01659802857',
        role_id: '3'
      },
      errors: {}
    }
  },
  methods: {
    login: function login() {
      axios.post('/api/login', this.employee).then(response => {
        if (response.data.message == 'successfully') {

          sessionStorage.setItem('authenticated', true);
          sessionStorage.setItem('id', response.data.employee.id);
          sessionStorage.setItem('fullname', response.data.employee.fullname);
          sessionStorage.setItem('avatar', response.data.employee.avatar);
          sessionStorage.setItem('role', response.data.employee.role);
          this.$root.authenticated = true;
          this.$root.role = response.data.employee.role;
          this.$router.push(this.$route.path);
        }else {
          sessionStorage.clear();
        }

      }).catch(error => {
        this.errors = error.response.data;
      });
    },
    register: function(){
      axios.post('/api/register', this.employeeRegister).then(response => {
        console.log(response.data);
      }).catch(error => {
        console.log(error.response);
      });
    }
  },
  mounted: function mounted() {
    //do something after mounting vue instance
    if (this.$root.authenticated) {
      this.$router.push('/');
    }
  },
  created: function created() {
    //do something after creating vue instance
    (function($) {
        $(document).ready(function() {
            $('.list-inline li > a').click(function() {
                var activeForm = $(this).attr('href') + ' > form';
                //console.log(activeForm);
                $(activeForm).addClass('animated fadeIn');
                //set timer to 1 seconds, after that, unload the animate animation
                setTimeout(function() {
                    $(activeForm).removeClass('animated fadeIn');
                }, 1000);
            });
        });
    })(jQuery);
  }
}
</script>
<style>
</style>
