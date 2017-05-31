
<template>
  <div>
    <div class="row">
      <div class="col-lg-12">
        <div class="box">
          <header>
            <div class="icons"><i class="fa fa-table"></i></div>
            <a type="button" data-toggle="modal" data-target="#myModal" href="#"><h5>Create</h5></a>

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
                    <form class="form-horizontal" id="popup-validation" @submit.prevent="create">
                      <div class="form-group ">
                        <label class="control-label col-lg-3">Created</label>
                        <div class="col-lg-6">
                            <!-- <input type="text" class="form-control" id="req" v-model="bill.created"> -->
                            <date-picker language="vi" format="dd-MM-yyyy" input-class="form-control" wrapper-class="created-date"  v-model="bill.created"></date-picker>
                            <span class="text-danger">{{errors.created ? errors.created[0] : ''}}</span>
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
          </header>
          <div id="collapse4 category" class="body">
            <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>created</th>
                  <th>Employee</th>
                  <th>Modified</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(billInput, index) in billInputs">
                  <td> {{ index+1 }} </td>
                  <td>{{billInput.created}}</td>
                  <td>{{billInput.fullname}}</td>
                  <td>
                    <router-link :to="{ name: 'billInput.modified', params: { id: billInput.id}}">
                      <a class="btn btn-success" href="javascript:void(0)">
                        Modified ({{billInput.count}} Items)
                      </a>
                    </router-link>
                  </td>
                  <td>
                    <click-confirm>
                      <a class="btn btn-danger" @click.prevent="destroy(billInput.id, index)" href="javascript:void(0)" > Delete</a>
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

  data: function data() {
    return {
      bill: {
        id: '',
        created: '',
        employee_id: sessionStorage.getItem('id')
      },
      billInputs: [],
      errors: {}
    }
  },
  methods: {
    getAllBill: function(){
      axios.get('/api/bill-input').then(response => {
        this.billInputs = response.data.billInputs
      }).catch(error => {
        console.log(error.response);
      });
    },
    create: function create() {
      axios.post('/api/bill-input/store', this.bill).then(response => {
        this.billInput = {};
        this.errors = {};
        this.billInputs =  [].concat(response.data.billInput, this.billInputs);
        //console.log(response.data);
      }).catch(error => {
        this.errors = error.response.data;
      });
    },
    destroy: function(id, index){
      axios.get('/api/bill-input/destroy/' + id).then(response => {
        this.billInputs.splice(index, 1);
      }).catch(error => {
        console.log(error.response);
      });
    },
  },
  mounted: function mounted() {
    //do something after mounting vue instance
    if (this.$root.authenticated) {
      this.getAllBill();
    }else {
      this.$router.push('/login')
    }

  }
}
</script>
<style>
</style>
