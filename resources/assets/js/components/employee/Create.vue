<template>
  <div>
    <div class="row">
      <div class="col-lg-12">
        <div class="box">
          <header class="dark">
            <div class="icons"><i class="fa fa-check"></i></div>
            <h5><router-link :to="{ name: 'employee'}">Back</router-link> Employee</h5>
            <!-- .toolbar -->
            <div class="toolbar">
              <nav style="padding: 8px;">
                  <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                      <i class="fa fa-minus"></i>
                  </a>
                  <a href="javascript:;" class="btn btn-default btn-xs full-box">
                      <i class="fa fa-expand"></i>
                  </a>
                  <a href="javascript:;" class="btn btn-danger btn-xs close-box">
                      <i class="fa fa-times"></i>
                  </a>
              </nav>
            </div>
            <!-- /.toolbar -->
          </header>
          <div id="collapse2" class="body">
            <form class="form-horizontal" id="popup-validation" @submit.prevent="create" enctype="multipart/form-data">
              <div class="form-group" :class="{'has-error': errors.username}">
                <label class="control-label col-lg-3">Username</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="req" v-model="employee.username">
                    <span class="text-danger">{{errors.username ? errors.username[0] : ''}}</span>
                </div>
              </div>
              <div class="form-group" :class="{'has-error': errors.password}">
                <label class="control-label col-lg-3">Password</label>
                <div class="col-lg-6">
                    <input type="password" class="form-control" id="req" v-model="employee.password">
                    <span class="text-danger">{{errors.password ? errors.password[0] : ''}}</span>
                </div>
              </div>
              <div class="form-group" :class="{'has-error': errors.repassword}">
                <label class="control-label col-lg-3">Re-Password</label>
                <div class="col-lg-6">
                    <input type="password" class="form-control" id="req" v-model="employee.repassword">
                    <span class="text-danger">{{errors.repassword ? errors.repassword[0] : ''}}</span>
                </div>
              </div>
              <div class="form-group" :class="{'has-error': errors.fullname}">
                <label class="control-label col-lg-3">Full Name</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="req" v-model="employee.fullname">
                    <span class="text-danger">{{errors.fullname ? errors.fullname[0] : ''}}</span>
                </div>
              </div>
              <div class="form-group" :class="{'has-error': errors.avatar}">
                <label class="control-label col-lg-3">Avatar</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="req" v-model="employee.avatar">
                    <span class="text-danger">{{errors.avatar ? errors.avatar[0] : ''}}</span>
                </div>
              </div>
              <div class="form-group" :class="{'has-error': errors.birthday}">
                <label class="control-label col-lg-3">Birthday</label>
                <div class="col-lg-6">
                    <!-- <input type="text" class="form-control" id="dp1" v-model="employee.birthday"> -->
                    <date-picker language="vi" format="dd MM yyyy" input-class="form-control"  v-model="employee.birthday"></date-picker>
                    <span class="text-danger">{{errors.birthday ? errors.birthday[0] : ''}}</span>
                </div>
              </div>
              <div class="form-group" :class="{'has-error': errors.gender}">
                <label class="control-label col-lg-3">Gender</label>
                <div class="col-lg-6">
                  <div class="checkbox">
                      <label>
                          <input class="uniform" type="radio" name="employee.gender" v-model="employee.gender" value="male" checked>
                          Male
                      </label>
                      <label>
                          <input class="uniform" type="radio" name="employee.gender" v-model="employee.gender" value="female" checked>
                          Female
                      </label>
                      <br>
                      <span class="text-danger">{{errors.gender ? errors.gender[0] : ''}}</span>
                  </div>
                </div>
              </div>
              <div class="form-group" :class="{'has-error': errors.address}">
                <label class="control-label col-lg-3">Address</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="req" v-model="employee.address">
                    <span class="text-danger">{{errors.address ? errors.address[0] : ''}}</span>
                </div>
              </div>
              <div class="form-group" :class="{'has-error': errors.phone}">
                <label class="control-label col-lg-3">Phone</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="req" v-model="employee.phone">
                    <span class="text-danger">{{errors.phone ? errors.phone[0] : ''}}</span>
                </div>
              </div>
              <div class="form-group" :class="{'has-error': errors.role_id}">
                <label class="control-label col-lg-3">Role</label>
                <div class="col-lg-6">
                  <select data-placeholder="Your Favorite Type of Bear" class="form-control chzn-select" tabindex="7" v-model="employee.role_id">
                    <option value=""></option>
                    <option v-for="role in roles" :value="role.id" >{{role.role}}</option>
                  </select>
                  <span class="text-danger">{{errors.role_id ? errors.role_id[0] : ''}}</span>
                </div>
              </div>
              <div class="col-lg-offset-3 form-actions no-margin-bottom">
                <input type="submit" value="Create" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>
</template>
<script>
export default {
  data: function(){
    return {
      employee: {
        username: '',
        password: '',
        repassword: '',
        fullname: '',
        avatar: '',
        birthday: '',
        gender: '',
        address: '',
        phone: '',
        role_id: ''
      },
      roles: [],
      errors: {}
    }
  },
  methods: {
    getAllRole: function getAllRole() {
      axios.get('/api/role').then(response => {
        this.roles = response.data.roles;
      }).catch(error => {
        console.log(error.response);
      });
    },
    create: function(){
      axios.post('/api/employee/store', this.employee).then(response => {
        this.employee = '';
        this.errors = '';
        this.$router.push('/employee');
      }).catch(error => {
        this.errors = error.response.data;
      })
    }
  },
  mounted: function mounted() {
    //do something after mounting vue instance
    if (this.$root.authenticated) {
      this.getAllRole();
    }else {
      this.$router.push('/login')
    }
  }
}
</script>
<style>
</style>
