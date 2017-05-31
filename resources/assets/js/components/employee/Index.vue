<template>
  <div>
    <div class="row">
      <div class="col-lg-12">
        <div class="box">
          <header>
            <div class="icons"><i class="fa fa-table"></i></div>
            <h5><router-link :to="{ name: 'employee.create'}">Create</router-link></h5>
          </header>
          <div id="collapse4" class="body">
            <div v-if="employees.length === 0" class="text-center">
              <h1>Empty</h1>
            </div>
            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Full Name</th>
                  <th>Avatar</th>
                  <th>Birthday</th>
                  <th>Gender</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(employee, index) in employees">
                  <td>{{index+1}}</td>
                  <td>{{employee.fullname}}</td>
                  <td>{{employee.avatar}}</td>
                  <td>{{employee.birthday}}</td>
                  <td>{{employee.gender}}</td>
                  <td>{{employee.role}}</td>
                  <td>
                    <router-link style="float: left" :to="{ name: 'employee.edit', params: { id: employee.id}}"><a class="btn btn-info" href="javascript:void(0)">Edit</a></router-link>

                    <click-confirm>
                      <a class="btn btn-danger" @click.prevent="destroy(employee.id, index)" href="javascript:void(0)" > Delete</a>
                    </click-confirm>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.row -->
    <!--End Datatables-->
  </div>
</template>
<script>
export default {
  data: function(){
    return {
      employees: []
    }
  },
  methods: {
    destroy: function(id, index){
      axios.get('/api/employee/destroy/' + id).then(response => {
        this.employees.splice(index, 1);
      }).catch(error => {
        console.log(error.response);
      });
    },
    getAllEmployee: function getAllEmployee() {
      axios.get('/api/employee').then(response => {
        this.employees = response.data.employees;
      }).catch(error => {
        console.log(error.response);
      });
    }
  },
  mounted: function mounted() {
    //do something after mounting vue instance
    if (this.$root.authenticated) {
      this.getAllEmployee();
    }else {
      this.$router.push('/login')
    }
  }
}
</script>
<style>
</style>
