<template>
    <div class="btn-group" v-if="this.$root.authenticated">
      <a @click.prevent="logout" class="btn btn-metis-1 btn-sm"><i class="fa fa-power-off"></i></a>
    </div>
</template>
<script>
export default {
  methods: {
    logout: function logout() {
      sessionStorage.clear();
      this.$router.push('/login');
      this.$root.authenticated = false;
    }
  },
}
</script>
<style>
</style>
