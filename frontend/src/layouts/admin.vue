<template>
  <div>
    <Navbar />
    <div class="container-fluid page-body-wrapper">
      <Sidebar />
      <div class="main-panel">
        <div class="content-wrapper">
          <nuxt />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Navbar, Sidebar } from "~/components/admin/";

export default {
  middleware: "admin",
  components: {
    Navbar,
    Sidebar
  },
  head() {
    return {
      link: [
        {
          rel: "stylesheet",
          href:
            "https://fonts.googleapis.com/css?family=Ubuntu:300i,400,500,700&display=swap"
        }
      ]
    };
  }
};
</script>
