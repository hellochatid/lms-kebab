<template>
  <div>
    <!-- Inner Page Breadcrumb -->
    <section class="inner_page_breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 offset-xl-3 text-center">
            <div class="breadcrumb_content">
              <h4 class="breadcrumb_title">Logın</h4>
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Logın</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Our LogIn Register -->
    <section class="our-log bgc-fa">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-lg-6 offset-lg-3">
            <div class="login_form inner_page">
              <form>
                <div class="heading">
                  <h3 class="text-center">Login to your account</h3>
                  <p class="text-center">
                    Don't have an account?
                    <a class="text-thm" href="/register">Sign Up!</a>
                  </p>
                </div>
                <div class="form-group">
                  <input
                    id="email"
                    class="form-control input"
                    type="email"
                    v-model="input.email"
                    placeholder="Type your email"
                  />
                </div>
                <div class="form-group">
                  <input
                    id="password"
                    class="form-control input"
                    type="password"
                    v-model="input.password"
                    placeholder="Type your password"
                  />
                </div>
                <div class="form-group custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="exampleCheck3" />
                  <label class="custom-control-label" for="exampleCheck3">Remember me</label>
                  <a class="tdu btn-fpswd float-right" href="#">Forgot Password?</a>
                </div>
                <button
                  type="button"
                  class="btn btn-log btn-block btn-primary"
                  @click="postLogin"
                >Login</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import auth from "~/services/auth";
import form from "~/libs/form";

export default {
  head: {
    title: "Login",
    meta: [
      {
        hid: "description",
        name: "description",
        content: "about page description"
      }
    ]
  },
  layout: "main",
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
      if (!form.validation({ email: "required", password: "required" })) return;

      auth.login(this, "member").then(res => {
        this.$router.push({
          path: "/course"
        });
      });
    }
  }
};
</script>
