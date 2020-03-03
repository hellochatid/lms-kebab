<template>
  <div class="limiter">
    <div class="container-login" style>
      <div class="wrap-login">
        <form class="login-form validate-form">
          <span class="login-form-title">Login</span>

          <div class="wrap-input validate-input" data-validate="Username is reauired">
            <span class="label-input">Email</span>
            <input
              id="email"
              class="input"
              type="email"
              v-model="input.email"
              placeholder="Type your email"
            />
            <span class="focus-input input-email"></span>
          </div>

          <div class="wrap-input validate-input" data-validate="Password is required">
            <span class="label-input">Password</span>
            <input
              id="password"
              class="input"
              type="password"
              v-model="input.password"
              placeholder="Type your password"
            />
            <span class="focus-input input-password"></span>
          </div>

          <div class="text-right forgot-password">
            <a href="#">Forgot password?</a>
          </div>

          <div class="container-login-form-btn">
            <div class="wrap-login-form-btn">
              <div class="login-form-bgbtn"></div>
              <button type="button" class="login-form-btn" @click="postLogin">Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import form from "~/libs/form";

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
      if (!form.validation({ email: "required", password: "required" })) return;

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
/*------------------------------------------*/
/*	   	General
/*------------------------------------------*/
body {
  font-family: "Ubuntu", sans-serif;
  color: #3e4b5b;
}

/*------------------------------------------*/
/*	   	Nuxt
/*------------------------------------------*/
.nuxt-progress {
  background: #ef5350;
}

/*------------------------------------------*/
/*	   	Login
/*------------------------------------------*/
.limiter {
  background: #9956f3;
  background: -webkit-linear-gradient(-135deg, #d708e2, #21bee1);
  background: -o-linear-gradient(-135deg, #d708e2, #21bee1);
  background: -moz-linear-gradient(-135deg, #d708e2, #21bee1);
  background: linear-gradient(-135deg, #d708e2, #21bee1);
}
.container-login {
  background-image: url("~assets/images/bg-coloris.jpg");
  width: 100%;
  min-height: 100vh;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  padding: 15px;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
}

.wrap-login {
  padding: 65px 55px 55px;
  width: 500px;
  background: #fff;
  border-radius: 10px;
  overflow: hidden;
}

.login-form-title {
  display: block;
  font-size: 40px;
  font-weight: 500;
  color: #333333;
  line-height: 1.2;
  text-align: center;
  padding-bottom: 49px;
}

/* input */
.wrap-input {
  width: 100%;
  position: relative;
  border-bottom: 2px solid #d9d9d9;
}

.label-input {
  font-size: 14px;
  color: #333333;
  line-height: 1.5;
  padding-left: 7px;
}
.input {
  outline: none;
  border: none;
  font-size: 16px;
  color: #333333;
  line-height: 1.2;

  display: block;
  width: 100%;
  height: 55px;
  background: transparent;
  padding: 0 7px 0 43px;
}

/* focus */
.focus-input {
  position: absolute;
  display: block;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  pointer-events: none;
}

.focus-input::after {
  color: #adadad;
  content: "arrow_forward";
  font-family: "Material Icons";
  font-weight: normal;
  font-style: normal;
  font-size: 18px;
  line-height: 1;
  text-transform: none;
  letter-spacing: normal;
  word-wrap: normal;
  white-space: nowrap;
  direction: ltr;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
  -moz-osx-font-smoothing: grayscale;
  font-feature-settings: "liga";

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  justify-content: center;
  position: absolute;
  height: calc(100% - 20px);
  bottom: 0;
  left: 0;
  padding-left: 13px;
  padding-top: 3px;
}

.focus-input::before {
  content: "";
  display: block;
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 0;
  height: 2px;
  background: #7f7f7f;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.input:focus + .focus-input::before {
  width: 100%;
}

.has-val.input + .focus-input::before {
  width: 100%;
}

.focus-input.input-email::after {
  content: "email";
}
.focus-input.input-password::after {
  content: "lock";
}
.input:focus + .focus-input::after {
  color: #a64bf4;
}

.has-val.input + .focus-input::after {
  color: #a64bf4;
}

/* button */
button {
  outline: none !important;
  border: none;
  background: transparent;
}
.container-login-form-btn {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
.wrap-login-form-btn {
  width: 100%;
  display: block;
  position: relative;
  z-index: 1;
  border-radius: 25px;
  overflow: hidden;
  margin: 0 auto;

  box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
  -moz-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
  -webkit-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
  -o-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
  -ms-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
}

.login-form-bgbtn {
  position: absolute;
  z-index: -1;
  width: 300%;
  height: 100%;
  background: #a64bf4;
  background: -moz-linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);
  background: -o-linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);
  background: -webkit-linear-gradient(
    right,
    #00dbde,
    #fc00ff,
    #00dbde,
    #fc00ff
  );
  top: 0;
  left: -100%;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}

.login-form-btn {
  font-size: 16px;
  color: #fff;
  line-height: 1.2;
  text-transform: uppercase;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 20px;
  width: 100%;
  height: 50px;
}

.wrap-login-form-btn:hover .login-form-bgbtn {
  left: 0;
}

.forgot-password {
  padding: 8px 0 32px;
}
.forgot-password a {
  font-size: 14px;
  color: #666666;
  margin: 0px;
  transition: all 0.4s;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
}
.forgot-password a:focus {
  outline: none !important;
}
.forgot-password a:hover {
  text-decoration: none;
  color: #a64bf4;
}

/* Alert */
#description-email,
#description-password {
  display: none;
}

</style>
