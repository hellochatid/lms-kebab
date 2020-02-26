<template>
  <div class="container-stroller">
    <div>
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  Kebab
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3">
                  <div class="form-group">
                    <label for="email"></label>
                    <input id="email" type="email" v-model="input.email" placeholder="Email"/>
                  </div>
                  <div class="form-group">
                    <label for="password"></label>
                    <input id="password" type="password" v-model="input.password" placeholder="Password"/>
                  </div>
                  <div class="mb-2 mt-24">
                    <button type="button" class="btn btn-block btn-primary" @click="postLogin">
                      <i class="mdi mdi-facebook mr-2"></i>Login</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
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
                name: "John Doe x",
                displayPicture: "http://keenthemes.com/preview/metronic/theme/assets/layouts/layout5/img/avatar1.jpg",
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
