<template>
    <div>
        ccs
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