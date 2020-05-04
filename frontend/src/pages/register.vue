<template>
  <div>
    <!-- Inner Page Breadcrumb -->
    <section class="inner_page_breadcrumb">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 offset-xl-3 text-center">
            <div class="breadcrumb_content">
              <h4 class="breadcrumb_title">Register</h4>
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="#">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Register</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Our LogIn Register -->
    <section class="our-log-reg bgc-fa">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-lg-12 mb-4">
            <div class="heading">
              <h3 class="text-center">Register to start learning</h3>
              <p class="text-center">
                Have an account?
                <a class="text-thm" href="/login">Login</a>
              </p>
            </div>
          </div>
          <div class="col-sm-12 col-lg-6 offset-lg-3">
            <div class="sign_up_form inner_page">
              <div class="details">
                <!-- <b-form autocomplete="off" @submit.stop.prevent="register" ref="form"> -->
                <b-form @submit.stop.prevent="register" ref="form">
                  <div id="step-1">
                    <b-form-group label-for="email">
                      <input
                        id="email"
                        name="email"
                        class="form-control"
                        type="email"
                        v-model="input.email"
                        placeholder="Type your email"
                      />
                    </b-form-group>
                    <button
                      type="button"
                      class="btn btn-log btn-block btn-success"
                      @click.stop="verifyEmail"
                    >Next</button>
                  </div>
                  <div id="step-2" class="d-none">
                    <div v-if="user.isExists">
                      <div class="image-wrapper w-128 h-128 m-0-auto circle">
                        <div v-if="user.image.url !== ''" class="crop-square">
                          <b-img :src="user.image.url"></b-img>
                        </div>
                        <p class="initial">{{ user.initial }}</p>
                      </div>
                      <span class="login-user-name">{{ user.name }}</span>
                      <div class="form-group">
                        <input
                          id="password"
                          name="password"
                          class="form-control"
                          type="password"
                          v-model="input.password"
                          placeholder="Type your password"
                          :disabled="disabled"
                        />
                      </div>
                    </div>
                    <div v-else>
                      <div class="form-group">
                        <p class="form-control">
                          <!-- TODO: styling padding -->
                          {{ input.email }}
                        </p>
                        <input
                          id="name"
                          name="name"
                          class="form-control"
                          type="text"
                          v-model="input.name"
                          placeholder="Type your name"
                          :disabled="disabled"
                        />
                        <input
                          id="set-password"
                          name="set_password"
                          class="form-control"
                          type="password"
                          v-model="input.set_password"
                          placeholder="Password"
                          :disabled="disabled"
                        />
                        <input
                          id="set-confirm-password"
                          name="set_confirm_password"
                          class="form-control"
                          type="password"
                          v-model="input.set_confirm_password"
                          placeholder="Confrim password"
                          :disabled="disabled"
                        />
                      </div>
                    </div>

                    <!-- <b-form-group> -->
                    <!-- TODO: add loading indicator when sendin request -->
                    <button
                      type="button"
                      class="btn btn-log btn-block btn-success"
                      :disabled="disabled"
                      @click="register"
                    >Register</button>
                    <!-- </b-form-group> -->
                    <div
                      class="text-center link"
                      @click="showStep1"
                    >&larr; {{ user.exists? 'Not You?':'Change email'}}</div>
                  </div>
                </b-form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import form from "~/libs/form";
import auth from "~/services/auth";
import users from "~/services/users";

export default {
  head: {
    title: "Register",
    meta: [
      {
        // TODO: Change meta
        name: "description",
        content: "about page description"
      }
    ]
  },
  layout: "main",
  methods: {
    showStep1() {
      this.disabled = false;
      this.user.isExists = false;
      const step1 = document.getElementById("step-1");
      const step2 = document.getElementById("step-2");
      step2.classList.add("d-none");
      step1.classList.remove("d-none");
    },
    showStep2() {
      this.disabled = false;
      const step1 = document.getElementById("step-1");
      const step2 = document.getElementById("step-2");
      step1.classList.add("d-none");
      step2.classList.remove("d-none");
    },
    verifyEmail() {
      const self = this;
      if (!form.validation({ email: "required" })) return;
      // TODO: check is valid email

      this.disabled = true;
      users
        .isExist(this)
        .then(user => {
          if (user.exists) {
            self.user.isExists = user.exists;
            self.user.initial = user.data.name.charAt(0);
            self.user.name = user.data.name;
            self.user.display_image = user.data.display_image;
          }

          // register new member
          self.showStep2();
        })
        .catch(err => {
          console.log(err.response);
        });
    },
    async register() {
      this.disabled = true;
      if (this.user.isExists) {
        await this.registerExistingUser();
      } else {
        await this.registerNewUser();
      }
      // this.disabled = false;
    },
    registerExistingUser() {
      users
        .registerExistingUser(this, "member")
        .then(res => {
          if (res.error) {
            // TODO: show error message
            return;
          }
          this.$router.push({
            path: "./register-success"
          });
        })
        .catch(err => {
          console.log(err.response);
        });
    },
    registerNewUser() {
      // TODO: form validation ?
      users
        .registerNewUser(this, "member")
        .then(res => {
          if (res.error) {
            // TODO: show error message
            return;
          }
          this.$router.push({
            path: "./register-success"
          });
        })
        .catch(err => {
          console.log(err.response);
        });
    }
  },
  data() {
    return {
      user: {
        isExists: false,
        initial: "",
        name: "",
        image: {
          url: "",
          dimension: ""
        }
      },
      input: {
        name: "",
        email: "",
        password: "",
        set_password: "",
        set_confirm_password: ""
      },
      disabled: false,
      formError: false
    };
  },
  mounted() {
    console.log(this.$router);
  }
};
</script>
