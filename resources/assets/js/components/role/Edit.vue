<template>
  <div>
    <div class="row">
      <div class="col-lg-12">
        <div class="box">
          <header class="dark">
            <div class="icons"><i class="fa fa-check"></i></div>
            <h5><router-link :to="{ name: 'role'}">Back</router-link> Role</h5>
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
            <form class="form-horizontal" id="popup-validation" @submit.prevent="updated">
              <div class="form-group ">
                <label class="control-label col-lg-3">Name</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="req" v-model="role.role">
                    <span class="text-danger">{{errors.role ? errors.role[0] : ''}}</span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-3">Description</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="req" v-model="role.description">
                    <span class="text-danger">{{errors.description ? errors.description[0] : ''}}</span>
                </div>
              </div>
              <div class="col-lg-offset-3 form-actions no-margin-bottom">
                <input type="submit" value="Update" class="btn btn-primary">
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
      role: {},
      errors:{}
    }
  },
  methods: {
    getRole: function getRole()
    {
    axios.get('/api/role/edit/' + this.$route.params.id)
      .then(response => {
        this.role = response.data.role
      })
      .catch(error =>{
        this.errors = error.response.data;
      });
    },
    updated: function(){
      axios.post('/api/role/update/' + this.$route.params.id, this.role)
      .then(response => {
        this.category = '';
        this.errors = '';
        this.$router.push('/role');
      })
      .catch(error => {
        if (error.response.data.error === 'Unauthenticated.') {
          this.$router.push('/login');
        }
        this.errors = error.response.data;
      });
    }
  },
  mounted: function mounted() {
    //do something after mounting vue instance
    if (this.$root.authenticated) {
      this.getRole();
    }else {
      this.$router.push('/login')
    }
  }
}
</script>
<style>
</style>
