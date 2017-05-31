<template>
  <div>
    <div class="row">
      <div class="col-lg-12">
        <div class="box">
          <header class="dark">
            <div class="icons"><i class="fa fa-check"></i></div>
            <h5><router-link :to="{ name: 'product'}">Back</router-link> Product</h5>
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
                    <input type="text" class="form-control" id="req" v-model="product.name">
                    <span class="text-danger">{{errors.name ? errors.name[0] : ''}}</span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-3">Intro</label>
                <div class="col-lg-6">
                    <!-- <textarea class="form-control" rows="8" cols="80" name="intro" v-model="product.intro"></textarea> -->
                    <ckeditor v-model="product.intro"></ckeditor>
                    <span class="text-danger">{{errors.intro ? errors.intro[0] : ''}}</span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-3">Content</label>
                <div class="col-lg-6">
                    <!-- <textarea class="form-control" rows="8" cols="80" name="contents" v-model="product.content"></textarea> -->
                    <ckeditor v-model="product.content"></ckeditor>
                    <span class="text-danger">{{errors.content ? errors.content[0] : ''}}</span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-3">Keywords</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="req" v-model="product.keywords">
                    <span class="text-danger">{{errors.intro ? errors.intro[0] : ''}}</span>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-3">Category</label>
                <div class="col-lg-6">
                  <select data-placeholder="Your Favorite Type of Bear" class="form-control chzn-select" tabindex="7" v-model="product.category_id">
                    <option value=""></option>
                    <option v-for="category in categories" :value="category.id" :selected="product.category_id === category.id ? true : false">{{category.name}}</option>
                  </select>
                    <span class="text-danger">{{errors.category_id ? errors.category_id[0] : ''}}</span>
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
      product: {},
      categories: [],
      errors: {}
    }
  },
  methods: {
    getProduct: function(){
      axios.get('/api/product/edit/' + this.$route.params.id)
      .then(response => {
        this.product = response.data.product
      })
      .catch(error => {
        this.errors = error.response.data;
      });
    },
    getAllCategory: function getAllCategory() {
      axios.get('/api/category').then(response => {
        this.categories = response.data.categories;
      }).catch(error => {
        console.log(error.response);
      });
    },
    updated: function(){
      axios.post('/api/product/update/' + this.$route.params.id, this.product)
      .then(response => {
        //console.log(response.data);
        this.product = '';
        this.errors = '';
        this.$router.push('/product');
      }).catch(error => {
        this.errors = error.response.data;
      });
    }
  },
  mounted: function mounted() {
    //do something after mounting vue instance
    if (this.$root.authenticated) {
      this.getAllCategory();
      this.getProduct();
    }else {
      this.$router.push('/login')
    }
  }
}
</script>
<style>
</style>
