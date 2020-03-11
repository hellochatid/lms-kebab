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
                  <li class="breadcrumb-item active" aria-current="page">Detail information</li>
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
              <h3 class="text-center">Register to become affiliate</h3>
              <p class="text-center">Already become an affiliate? <a class="text-thm" href="/login">Login</a></p>
            </div>
          </div>
          <div class="col-sm-12 col-lg-6 offset-lg-3">
            <div class="sign_up_form inner_page">
              <div class="details">
                <form action="../affiliate">
                  <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputEmail4" placeholder="Email Address">
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Confirm Password">
                  </div>
                  <button type="submit" class="btn btn-log btn-block btn-success">Register affiliate</button>
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
    title: "Register Affiliate",
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
