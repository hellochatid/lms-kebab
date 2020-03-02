<template>
  <div class="limiter">
    <div class="container-login">
      <div class="wrap-login">
        <div class="login-pic" data-tilt>
          <img src="~/assets/images/member-login.png" alt />
        </div>

        <form class="login-form validate-form">
          <span class="login-form-title">Member Login</span>

          <div
            class="wrap-input validate-input"
            data-validate="Valid email is required: ex@abc.xyz"
          >
            <input class="input" type="text" name="email" placeholder="Email" />
            <span class="focus-input"></span>
            <span class="symbol-input">
              <i class="material-icons icon">email</i>
            </span>
          </div>

          <div class="wrap-input validate-input" data-validate="Password is required">
            <input class="input" type="password" name="pass" placeholder="Password" />
            <span class="focus-input"></span>
            <span class="symbol-input">
              <i class="material-icons icon">lock</i>
            </span>
          </div>

          <div class="container-login-form-btn">
            <button class="login-form-btn">Login</button>
          </div>

          <div class="text-center lnk-forgot-password">
            <span>Forgot</span>
            <a href="#">Password?</a>
          </div>

          <div class="text-center lnk-create-account">
            <a href="#">Create your Account</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import "~/assets/css/style.css";

export default {
  head() {
    return {
      title: "Member - Login",
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

<style>
/*------------------------------------------*/
/*	   	General
/*------------------------------------------*/
a {
  transition: all 0.4s;
  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
}

a:focus {
  outline: none !important;
}

a:hover {
  text-decoration: none;
  color: #57b846 !important;
}

/*------------------------------------------*/
/*	   	Login
/*------------------------------------------*/
.limiter {
  width: 100%;
  margin: 0 auto;
}
.container-login {
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
  background: #9053c7;
  background: -webkit-linear-gradient(-135deg, #c850c0, #4158d0);
  background: -o-linear-gradient(-135deg, #c850c0, #4158d0);
  background: -moz-linear-gradient(-135deg, #c850c0, #4158d0);
  background: linear-gradient(-135deg, #c850c0, #4158d0);
}
.wrap-login {
  width: 960px;
  background: #fff;
  border-radius: 10px;
  overflow: hidden;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  padding: 177px 130px 33px 95px;
}
.login-pic {
  width: 316px;
}

.login-pic img {
  max-width: 100%;
}
.login-form {
  width: 290px;
}

.login-form-title {
  font-size: 24px;
  font-weight: 500;
  color: #333333;
  line-height: 1.2;
  text-align: center;

  width: 100%;
  display: block;
  padding-bottom: 54px;
}
.wrap-input {
  position: relative;
  width: 100%;
  z-index: 1;
  margin-bottom: 10px;
}
.input {
  font-size: 15px;
  line-height: 1.5;
  color: #666666;

  display: block;
  width: 100%;
  background: #e6e6e6;
  height: 50px;
  border-radius: 25px;
  padding: 0 30px 0 68px;
}

/*------------------------------------------*/
/*	   	Input
/*------------------------------------------*/
input {
  outline: none;
  border: none;
}
input:focus {
  border-color: transparent !important;
}
input:focus::-webkit-input-placeholder {
  color: transparent;
}
input:focus:-moz-placeholder {
  color: transparent;
}
input:focus::-moz-placeholder {
  color: transparent;
}
input:focus:-ms-input-placeholder {
  color: transparent;
}
input::-webkit-input-placeholder {
  color: #999999;
}
input:-moz-placeholder {
  color: #999999;
}
input::-moz-placeholder {
  color: #999999;
}
input:-ms-input-placeholder {
  color: #999999;
}

/*------------------------------------------*/
/*	   	Focus
/*------------------------------------------*/
.focus-input {
  display: block;
  position: absolute;
  border-radius: 25px;
  bottom: 0;
  left: 0;
  z-index: -1;
  width: 100%;
  height: 100%;
  box-shadow: 0px 0px 0px 0px;
  color: rgba(87, 184, 70, 0.8);
}
.input:focus + .focus-input {
  -webkit-animation: anim-shadow 0.5s ease-in-out forwards;
  animation: anim-shadow 0.5s ease-in-out forwards;
}
@-webkit-keyframes anim-shadow {
  to {
    box-shadow: 0px 0px 70px 25px;
    opacity: 0;
  }
}
@keyframes anim-shadow {
  to {
    box-shadow: 0px 0px 70px 25px;
    opacity: 0;
  }
}
.symbol-input {
  font-size: 15px;

  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  align-items: center;
  position: absolute;
  border-radius: 25px;
  bottom: 0;
  left: 0;
  width: 100%;
  height: 100%;
  padding-left: 35px;
  pointer-events: none;
  color: #666666;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}
.symbol-input .icon {
  font-size: 16px;
}
.input:focus + .focus-input + .symbol-input {
  color: #57b846;
  padding-left: 28px;
}

/*------------------------------------------*/
/*	   	Button & link
/*------------------------------------------*/
button {
  outline: none !important;
  border: none;
  background: transparent;
}

button:hover {
  cursor: pointer;
}
.container-login-form-btn {
  width: 100%;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  padding-top: 20px;
}

.login-form-btn {
  font-size: 15px;
  line-height: 1.5;
  color: #fff;
  text-transform: uppercase;

  width: 100%;
  height: 50px;
  border-radius: 25px;
  background: #57b846;
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 25px;

  -webkit-transition: all 0.4s;
  -o-transition: all 0.4s;
  -moz-transition: all 0.4s;
  transition: all 0.4s;
}
.login-form-btn:hover {
  background: #333333;
}
.lnk-forgot-password {
  margin-top: 6px;
  font-size: 13px;
  line-height: 1.5;
  color: #999999;
}
.lnk-forgot-password a {
  font-weight: 400;
  color: #666666;
}
.lnk-create-account {
  padding-top: 130px;
  font-size: 13px;
  line-height: 1.5;
  color: #666666;
  font-weight: 400;
}
.lnk-create-account a {
  color: #666666;
  position: relative;
}
.lnk-create-account a::after {
  position: absolute;
  font-size: 18px;
  top: -1px;
  right: -30px;
  content: "arrow_forward";
  font-family: "Material Icons";
  font-weight: normal;
  font-style: normal;
  display: inline-block;
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
}

/*------------------------------------------*/
/*	   	Responsive
/*------------------------------------------*/
@media (max-width: 992px) {
  .wrap-login {
    padding: 177px 90px 33px 85px;
  }

  .login-pic {
    width: 35%;
  }

  .login-form {
    width: 50%;
  }
}

@media (max-width: 768px) {
  .wrap-login {
    padding: 100px 80px 33px 80px;
  }

  .login-pic {
    display: none;
  }

  .login-form {
    width: 100%;
  }
}

@media (max-width: 576px) {
  .wrap-login {
    padding: 100px 15px 33px 15px;
  }
}

/*------------------------------------------*/
/*	   	Alert validate
/*------------------------------------------*/
.validate-input {
  position: relative;
}
.alert-validate::before {
  content: attr(data-validate);
  position: absolute;
  max-width: 70%;
  background-color: white;
  border: 1px solid #c80000;
  border-radius: 13px;
  padding: 4px 25px 4px 10px;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -moz-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  -o-transform: translateY(-50%);
  transform: translateY(-50%);
  right: 8px;
  pointer-events: none;

  color: #c80000;
  font-size: 13px;
  line-height: 1.4;
  text-align: left;

  visibility: hidden;
  opacity: 0;

  -webkit-transition: opacity 0.4s;
  -o-transition: opacity 0.4s;
  -moz-transition: opacity 0.4s;
  transition: opacity 0.4s;
}
.alert-validate::after {
  content: "error_outline";
  font-family: "Material Icons";
  font-weight: normal;
  font-style: normal;
  font-size: 24px;
  display: inline-block;
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
}
.alert-validate:hover:before {
  visibility: visible;
  opacity: 1;
}
@media (max-width: 992px) {
  .alert-validate::before {
    visibility: visible;
    opacity: 1;
  }
}
</style>
