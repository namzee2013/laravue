<template>
    <div class="media user-media bg-dark dker" v-if="this.$root.authenticated">
      <div class="user-media-toggleHover">
        <span class="fa fa-user"></span>
      </div>
      <div class="user-wrapper bg-dark">
        <a class="user-link" href="">
          <img class="media-object img-thumbnail user-img" alt="User Picture" src="public/assets/img/user.gif">
          <span class="label label-danger user-label">16</span>
        </a>
        <div class="media-body">
          <h5 class="media-heading">{{fullname}}</h5>
          <ul class="list-unstyled user-info">
            <li><a href="">Administrator</a></li>
            <li>Role : {{this.$root.role}}<br>
              <small><i class="fa fa-calendar"></i>&nbsp;16 Mar 16:32</small>
            </li>
          </ul>
        </div>
      </div>
    </div>
</template>
<script>
export default {
  data: function(){
    return {
      fullname: '',
      avatar: '',
    }
  },
  mounted: function mounted() {
    //do something after mounting vue instance
    this.fullname = sessionStorage.getItem('fullname');
    this.avatar = sessionStorage.getItem('avatar');
  }
}
</script>
<style>
</style>
