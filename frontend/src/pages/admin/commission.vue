<template>
<div>
  
</div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";

export default {
  data: {
    content: "Hello World!"
  },
  //middleware: "admin",
  head: {
    title: "Comission | Admin Kebab"
  },
  layout: "admin",
  computed: mapGetters({
    adminUser: "users/adminUser"
  })
};
</script>
