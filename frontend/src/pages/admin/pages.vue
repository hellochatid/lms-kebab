<template>

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="material-icons icon">insert_drive_file</i>
    </span> 
    Pages 
  </h3>
</div>

</template>

<script>
import { mapMutations, mapGetters } from "vuex";

export default {
  middleware: "admin",
  head: {
    title: "Admin - Pages"
  },
  layout: "admin",
  computed: mapGetters({
    userAdmin: "users/userAdmin"
  }),
};
</script>