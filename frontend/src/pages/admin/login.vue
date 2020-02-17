<template>
  <div class="container">
    <h1>Sign in</h1>
    <div>
      <label for="email">
        <input id="email" type="email" v-model="input.email" />
      </label>
      <label for="password">
        <input id="password" type="password" v-model="input.password" />
      </label>
      <button @click="postLogin">login</button>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
const Cookie = process.client ? require("js-cookie") : undefined;

export default {
  head: {
    title: "Admin - Login"
  },
  data() {
    return {
      input: {
        email: "",
        password: ""
      },
      disabled: false,
      formError: false,
      modal: {
        hideHeader: true,
        hideFooter: true
      }
    };
  },
  methods: {
    postLogin(e) {
      this.$axios
        .post("/iam/login", {
          password: this.input.password,
          email: this.input.email
        })
        .then(res => {
          if (res.status === 200) {
            if (typeof res.data.success !== "undefined" && !res.data.success) {
              console.log(res.data.message);
            } else if (res.data.access_token) {
              var authAdmin = {
                name: "John Doe",
                token: res.data.access_token,
                authenticated: true
              };
              this.$store.commit("users/setUserAdmin", authAdmin);
              Cookie.set("authAdmin", authAdmin);
              this.$router.push({
                path: "/admin"
              });
            }
          }
        });
    }
  }
};
</script>
