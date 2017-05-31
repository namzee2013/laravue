<template>
  <div>
    <ul id="menu" class="bg-blue dker">
      <li class="nav-header">Menu</li>
      <li class="nav-divider"></li>
      <li class="">
        <router-link to="/"><i class="fa fa-dashboard"></i><span class="link-title">&nbsp;Dashboard</span></router-link>
      </li>
      <li>
        <router-link to="/role"><i class="fa fa-table"></i><span class="link-title">&nbsp;Role</span></router-link>
      </li>
      <li>
        <router-link to="/employee"><i class="fa fa-table"></i><span class="link-title">&nbsp;Employee</span></router-link>
      </li>
      <li>
        <router-link to="/category"><i class="fa fa-table"></i><span class="link-title">&nbsp;Category</span></router-link>
      </li>
      <li>
        <router-link to="/product"><i class="fa fa-table"></i><span class="link-title">&nbsp;Product</span></router-link>
      </li>
      <li>
        <router-link to="/bill-input"><i class="fa fa-table"></i><span class="link-title">&nbsp;Bill Input</span></router-link>
      </li>
      <li>
        <router-link to="/shopping"><i class="fa fa-table"></i><span class="link-title">&nbsp;Shopping</span></router-link>
      </li>
    </ul>
  </div>
</template>
<script>
export default {

}
</script>
<style>
</style>
