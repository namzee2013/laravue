<template>
  <div>
    <div class="row">
      <div class="col-lg-12">
        <div class="box">
          <header>
            <div class="icons"><i class="fa fa-table"></i></div>
            <h5><router-link :to="{ name: 'category.create'}">Create</router-link></h5>
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
                <tr v-for="(category, index) in categories">
                  <td> {{ index+1 }} </td>
                  <td>{{category.name}}</td>
                  <td>{{category.description}}</td>
                  <td>
                    <router-link style="float: left" :to="{ name: 'category.edit', params: { id: category.id}}"><a class="btn btn-info" href="javascript:void(0)">Edit</a></router-link>

                    <click-confirm style="float: left">
                      <a class="btn btn-danger" @click.prevent="destroy(category.id, index)" href="javascript:void(0)" > Delete</a>
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
      categories: [],
    }
  },
  methods: {
    destroy: function(id, index){
      axios.get('/api/category/destroy/' + id).then(response => {
        this.categories.splice(index, 1);
      }).catch(error => {
        console.log(error.response);
      });
    },
    getAllCategory: function getAllCategory() {
      axios.get('/api/category').then(response => {
        this.categories = response.data.categories;
      }).catch(error => {
        if (error.response.data.error === 'Unauthenticated.') {
          this.$router.push('/login');
        }
      });
    }
  },
  mounted: function mounted() {
    //do something after mounting vue instance
    if (this.$root.authenticated) {
      this.getAllCategory();
    }else {
      this.$router.push('/login')
    }
  }
}

</script>
<style>
</style>
