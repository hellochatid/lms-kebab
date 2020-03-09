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
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
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
          <div class="col-sm-12 col-lg-6 offset-lg-3">
            <div class="sign_up_form inner_page">
              <div class="heading">
                <h3 class="text-center">Register to start learning</h3>
                <p class="text-center">Have an account? <a class="text-thm" href="/login">Login</a></p>
              </div>
              <div class="details">
                <form action="#">
                  <div class="form-group">
                      <input type="text" class="form-control" id="exampleInputName2" placeholder="Username">
                  </div>
                   <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email Address">
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword5" placeholder="Confirm Password">
                  </div>
                  <div class="form-group custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="exampleCheck3">
                    <label class="custom-control-label" for="exampleCheck3">Want to become an instructor?</label>
                  </div>
                  <button type="submit" class="btn btn-log btn-block btn-success">Register</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  head: {
    title: "Register",
    meta: [
      {
        hid: "description",
        name: "description",
        content: "about page description"
      }
    ]
  },
  layout: "main"
};
</script>
