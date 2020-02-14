<template>
  <div class="container">
    <h1>Login</h1>
    <button @click="login">Login</button>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";

export default {
  head: {
    title: "Admin - Login"
  },
  methods: {
    login(e) {
      this.$store.commit("users/setUserAdmin", {
        name: "xx",
        authenticated: true
      });
      this.$router.push({
        path: "/admin"
      });
    }
  }
};
</script>