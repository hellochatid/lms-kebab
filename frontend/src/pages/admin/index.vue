<template>
  <div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="material-icons icon">home</i>
      </span> 
      Dashboard 
    </h3>
  </div>
  <!--<div>
    <h1>Admin</h1>
    <h2>{{ userAdmin.name }}</h2>
  </div>-->
</template>

<script>
import { mapMutations, mapGetters } from "vuex";

export default {
  middleware: "admin",
  head: {
    title: "Admin - Dashboard"
  },
  layout: "admin",
  computed: mapGetters({
    userAdmin: "users/userAdmin"
  }),
};
</script>