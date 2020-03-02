<template>
  <div class="container">
    <h1>Affiliate</h1>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import { ConfirmDelete } from "~/components/admin";
import courses from "~/services/courses";

export default {
  head: {
    title: "Affiliate"
  },
  layout: "affiliate"
};
</script>
