<template>
  <div>
    <div class="row" v-if="this.$root.authenticated">
      <div class="col-lg-12">
        <div class="box">
          <header>
            <div class="icons"><i class="fa fa-table"></i></div>
            <h5><router-link :to="{ name: 'role.create'}">Create</router-link></h5>
          </header>
          <div id="collapse4 category" class="body">
            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(role, index) in roles">
                  <td> {{ index+1 }} </td>
                  <td>{{role.role}}</td>
                  <td>{{role.description}}</td>
                  <td>
                    <router-link style="float: left" :to="{ name: 'role.edit', params: { id: role.id}}"><a class="btn btn-info" href="javascript:void(0)">Edit</a></router-link>

                    <click-confirm>
                      <a class="btn btn-danger" @click.prevent="destroy(role.id, index)" href="javascript:void(0)" > Delete</a>
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
  props: ['authenticated'],
  data: function(){
    return {
      roles: [],
    }
  },
  methods: {
    getAllRole: function getAllRole() {
      axios.get('/api/role').then(response => {
        this.roles = response.data.roles;
      }).catch(error => {
        console.log(error.response);
        // if (error.response.data.error === 'Unauthenticated.') {
        //   this.$router.push('/login');
        // }
      });
    },
    destroy: function(id, index){
      axios.get('/api/role/destroy/' + id).then(response => {
        this.roles.splice(index, 1);
      }).catch(error => {
        console.log(error.response);
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
