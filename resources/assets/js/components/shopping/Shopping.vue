<template>
  <div>
    <div class="row" v-if="this.$root.authenticated">
      <div class="col-lg-12">
        <div class="box">
          <header>
            <div class="icons"><i class="fa fa-table"></i></div>
          </header>
          <div id="collapse4 category" class="body">
            <form class="form-horizontal" id="popup-validation" @submit.prevent="shopping">
              <div class="form-group ">
                <label class="control-label col-lg-3">ID</label>
                <div class="col-lg-6">
                    <input type="text" class="form-control" id="req" v-model="item.id">
                    <span class="text-danger">{{errors.id ? errors.id[0] : ''}}</span>
                </div>
              </div>

              <div class="form-group ">
                <label class="control-label col-lg-3">Qty</label>
                <div class="col-lg-6">
                    <input type="number" class="form-control" id="req" :value="1" v-model="item.qty" >
                    <span class="text-danger">{{errors.qty ? errors.qty[0] : ''}}</span>
                </div>
              </div>
              <div class="col-lg-offset-3 form-actions no-margin-bottom">
                <input type="submit" value="Create" class="btn btn-primary">
                <span v-if="empty" class="text-center">NOT FOUND</span>
              </div>
            </form>
          </div>

          <div id="collapse4 category" class="body">
            <button type="button" class="btn btn-success" @click.prevent="payment"><h4>Payment {{total}}</h4></button>
            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Id</th>
                  <th>name</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Subtotal</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(item, index) in cart.products">
                  <td> {{ index+1 }} </td>
                  <td>{{item.id}}</td>
                  <td>{{item.name}}</td>
                  <td>{{item.qty}}</td>
                  <td>{{item.price}}</td>
                  <td>{{item.subtotal}}</td>
                  <td>
                    <a class="btn btn-danger" @click.prevent="destroy(index, item.subtotal)" href="javascript:void(0)">Delete</a>
                    <!-- <router-link style="float: left" :to="{ name: 'role.edit', params: { id: role.id}}"><a class="btn btn-info" href="javascript:void(0)">Edit</a></router-link>

                    <click-confirm>
                      <a class="btn btn-danger" @click.prevent="destroy(role.id, index)" href="javascript:void(0)" > Delete</a>
                    </click-confirm> -->
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
      item: {
        id: '',
        qty: '',
      },
      cart: {
        employee_id: sessionStorage.getItem('id'),
        products: []
      },
      errors: {},
      total: 0,
      empty: false,
    }
  },
  methods: {
    shopping: function() {

      axios.post('/api/shopping/get-product', this.item)
      .then(response => {
        this.cart.products.push(response.data.product);
        this.total += response.data.product.subtotal;
        this.empty = false;
        this.item = {};
        //console.log(response.data);
      }).catch(error => {
        this.empty = true;
      });
    },
    destroy: function(index, subtotal){
      this.cart.products.splice(index, 1);
      this.total -= subtotal;
    },
    payment: function(){

      if (this.total > 0) {
        axios.post('/api/shopping/payment', this.cart)
        .then(response => {
          this.cart.products = [];
          this.total = 0;
          window.open("http://laravue-namtt.herokuapp.com/bill/"+response.data.billID, "_blank", "resizable=yes, scrollbars=yes, titlebar=yes, width=700, height=400, top=10, left=10");

        }).catch(error => {
          console.log(error.response);
        });
      }
      else {
        alert('Please insert product');
      }
    }
  }
}
</script>
<style>
</style>
