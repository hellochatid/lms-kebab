<template>
  <div class="container-stroller">
    <div>
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">Kebab</div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3">
                  <div class="form-group">
                    <label for="email"></label>
                    <input id="email" type="email" v-model="input.email" placeholder="Email" />
                  </div>
                  <div class="form-group">
                    <label for="password"></label>
                    <input
                      id="password"
                      type="password"
                      v-model="input.password"
                      placeholder="Password"
                    />
                  </div>
                  <div class="mb-2 mt-24">
                    <button type="button" class="btn btn-block btn-primary" @click="postLogin">
                      <i class="mdi mdi-facebook mr-2"></i>Login
                    </button>
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
import "~/assets/css/admin.css";
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
                displayPicture:
                  "http://keenthemes.com/preview/metronic/theme/assets/layouts/layout5/img/avatar1.jpg",
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

<style>
.container-scroller {
  overflow: hidden;
}
.page-body-wrapper.full-page-wrapper {
  width: 100%;
  min-height: 100vh;
  background: #f2edf3;
}
.page-body-wrapper {
  min-height: calc(100vh - 70px);
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  -ms-flex-direction: row;
  flex-direction: row;
  padding-left: 0;
  padding-right: 0;
}
.container-fluid {
  width: 100%;
  padding-right: 20px;
  padding-left: 20px;
  margin-right: auto;
  margin-left: auto;
}
.content-wrapper {
  background: #f2edf3;
  padding: 2.75rem 2.25rem;
  width: 100%;
  -webkit-box-flex: 1;
  -ms-flex-positive: 1;
  flex-grow: 1;
}
.flex-grow {
  -webkit-box-flex: 1;
  -ms-flex-positive: 1;
  flex-grow: 1;
}
.auth .auth-form-light {
  background: #ffffff;
}
.auth .brand-logo {
  margin-bottom: 2rem;
  margin-bottom: 2rem;
  font-weight: bold;
  font-size: 2rem;
  color: #fe8196;
}
font-weight-light {
  font-weight: 300 !important;
}
.pt-3,
.py-3,
.card-revenue-table .revenue-item {
  padding-top: 1rem !important;
}
.auth form .form-group {
  margin-bottom: 1.5rem;
}
.auth form .form-group .form-control {
  background: transparent;
  border-radius: 0;
  font-size: 0.9375rem;
}
.auth form .form-group {
  margin-bottom: 0.5rem;
}
.mt-24 {
  margin-top: 24px;
}
.form-control {
  border: 1px solid #ebedf2;
  font-size: 0.8125rem;
  display: block;
  width: 100%;
  font-weight: 400;
  color: #495057;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out,
    -webkit-box-shadow 0.15s ease-in-out;
}
.form-control-lg {
  height: 3.175rem;
  padding: 0.94rem 1.94rem;
  font-size: 1.25rem;
  line-height: 1.5;
  border-radius: 0.3rem;
}
.form-group input {
  width: 100%;
  padding: 0.5rem 1rem;
  border-radius: 6px;
  border: 1px #e1e1e1 solid;
}
</style>
