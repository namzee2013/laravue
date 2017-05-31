<template>
  <div>
    <div class="row">
      <div class="col-lg-12">
        <div class="box">
          <header>
            <div class="icons"><i class="fa fa-table"></i></div>
            <h5><router-link :to="{ name: 'product.create'}">Create</router-link></h5>
          </header>
          <div id="collapse4 category" class="body">
            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Keywords</th>
                  <th>Category</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(product, index) in products">
                  <td> {{ index+1 }} </td>
                  <td>{{product.name}}</td>
                  <td>{{product.slug}}</td>
                  <td>{{product.keywords}}</td>
                  <td>{{product.category_name}}</td>
                  <td>
                    <router-link style="float: left" :to="{ name: 'product.edit', params: { id: product.id}}"><a class="btn btn-info" href="javascript:void(0)">Edit</a></router-link>

                    <click-confirm style="float: left">
                      <a class="btn btn-danger" @click.prevent="destroy(product.id, index)" href="javascript:void(0)" > Delete</a>
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
      products: [],
    }
  },
  methods: {
    destroy: function(id, index){
      axios.get('/api/product/destroy/' + id).then(response => {
        this.products.splice(index, 1);
      }).catch(error => {
        console.log(error.response);
      });
    },
    getAllProduct: function getAllProduct() {
      axios.get('/api/product').then(response => {
        this.products = response.data.products;
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
      this.getAllProduct();
    }else {
      this.$router.push('/login')
    }
  }
}

</script>
<style>
</style>
