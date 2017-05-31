<template>
  <div>
    <div class="row">
      <div class="col-lg-12">
        <div class="box">
          <header class="dark">
            <div class="icons"><i class="fa fa-check"></i></div>
            <h5><router-link :to="{ name: 'billInput'}">Back</router-link> Bill Input</h5>
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

            <a class="btn btn-primary" type="button" data-toggle="modal" data-target="#myModal" href="#"><span><i class="fa fa-plus" aria-hidden="true">ADD</i></span></a>

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Modal Header</h4>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal" id="popup-validation" @submit.prevent="add">

                      <div class="form-group" :class="{'has-error': errors.product_id}">
                        <label class="control-label col-lg-3">Product</label>
                        <div class="col-lg-6">
                          <select data-placeholder="Your Favorite Type of Bear" class="form-control chzn-select" tabindex="7" v-model="billProduct.product_id">
                            <option value=""></option>
                            <option v-for="product in products" :value="product.id" >{{product.name}}</option>
                          </select>
                          <span class="text-danger">{{errors.product_id ? errors.product_id[0] : ''}}</span>
                        </div>
                      </div>
                      <div class="form-group" :class="{'has-error': errors.qty}">
                        <label class="control-label col-lg-3">Qty</label>
                        <div class="col-lg-6">
                          <input type="number" class="form-control" id="req" v-model="billProduct.qty">
                          <span class="text-danger">{{errors.qty ? errors.qty[0] : ''}}</span>
                        </div>
                      </div>
                      <div class="form-group" :class="{'has-error': errors.price_bought}">
                        <label class="control-label col-lg-3">Price Bought</label>
                        <div class="col-lg-6">
                          <input type="number" class="form-control" id="req" v-model="billProduct.price_bought">
                          <span class="text-danger">{{errors.price_bought ? errors.price_bought[0] : ''}}</span>
                        </div>
                      </div>
                      <div class="form-group" :class="{'has-error': errors.status}">
                        <label class="control-label col-lg-3">Status</label>
                        <div class="col-lg-6">
                          <div class="checkbox">
                              <label>
                                  <input class="uniform" type="radio" name="billProduct.status" v-model="billProduct.status" value="0">
                                  Hide
                              </label>
                              <label>
                                  <input class="uniform" type="radio" name="billProduct.status" v-model="billProduct.status" value="1">
                                  Show
                              </label>
                              <br>

                          </div>
                          <span class="text-danger">{{errors.status ? errors.status[0] : ''}}</span>
                        </div>
                      </div>
                      <div class="form-group" :class="{'has-error': errors.price}">
                        <label class="control-label col-lg-3">Price</label>
                        <div class="col-lg-6">
                          <input type="number" class="form-control" id="req" v-model="billProduct.price">
                          <span class="text-danger">{{errors.price ? errors.price[0] : ''}}</span>
                        </div>
                      </div>

                      <div class="col-lg-offset-3 form-actions no-margin-bottom">
                        <input type="submit" value="Create" class="btn btn-primary">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>
            <!-- END Modal -->

              <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price Bought</th>
                    <th>price</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(billProduct, index) in billProducts">
                    <td>{{index+1}}</td>
                    <td>{{billProduct.name}}</td>
                    <td>{{billProduct.qty}}</td>
                    <td>{{billProduct.price_bought}}</td>
                    <td>{{billProduct.price}}</td>
                    <td>

                      <click-confirm>
                        <a class="btn btn-danger" @click.prevent="destroy(billProduct.id, index)" href="javascript:void(0)">Delete</a>
                      </click-confirm>

                    </td>
                  </tr>
                </tbody>
              </table>
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

  name: "",
  data: function data() {
    return {
      products: [],
      billProducts: [],
      billProduct: {
        product_id: '',
        qty: '',
        price_bought: '',
        status: '',
        price: '',
        bill_input_id: this.$route.params.id
      },
      errors: {},
    }
  },
  methods: {

    getProductForBill: function(){
      axios.get('/api/bill-input/get-product/' + this.$route.params.id)
      .then(response => {
        this.billProducts = response.data.productsForBill;
        //console.log(response.data);
      }).catch(error => {
        console.log(error.response);
      })
    },
    add: function()
    {
      axios.post('/api/bill-input/product/store', this.billProduct)
      .then(response => {
        //console.log(response.data);
        this.billProducts = [].concat(response.data.product, this.billProducts);
        this.errors = {};
        //this.billProduct = {};
        this.billProduct.product_id = '';
        this.billProduct.qty = '';
        this.billProduct.price_bought = '';
        this.billProduct.status = '';
        this.billProduct.price = '';
      }).catch(error => {
        this.errors = error.response.data;
      });

    },
    getAllProduct: function(){
      axios.get('/api/product').then(response => {
        this.products = response.data.products;
      }).catch(error => {
        console.log(error.response);
      });
    },
    destroy: function(id, index){
      axios.get('/api/bill-input/product/destroy/' + id).then(response => {
        this.billProducts.splice(index, 1);
      }).catch(error => {
        console.log(error.response);
      });

    }
  },
  mounted: function mounted() {
    //do something after mounting vue instance
    if (this.$root.authenticated) {
      this.getProductForBill();
      this.getAllProduct();
    }else {
      this.$router.push('/login')
    }

  }
}
</script>
<style>
</style>
