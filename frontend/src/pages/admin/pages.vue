<template>
  <div id="top">
    <!-- Text Editor -->
    <TuiEditor mode="markdown" preview-style="vertical" height="300px" />

    <!-- Markdown Viewer -->
    <TuiEditorViewer :value="content" />
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";

export default {
  data: {
    content: "Hello World!"
  },
  middleware: "admin",
  head: {
    title: "Admin - Pages"
  },
  layout: "admin",
  computed: mapGetters({
    userAdmin: "users/userAdmin"
  })
};
</script>