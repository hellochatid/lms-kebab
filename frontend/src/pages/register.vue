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
              <h3 class="text-center">Register to start learning</h3>
              <p class="text-center">Have an account? <a class="text-thm" href="/login">Login</a></p>
            </div>
          </div>
          <div class="col-sm-12 col-lg-6 offset-lg-3">
            <div class="sign_up_form inner_page">
              <div class="details">
                <form action="../verify-email">
                  <div class="col-lg-3 offset-lg-2 mb-3">
                    <div class="wrap-custom-file">
                      <input type="file" name="image1" id="image1" accept=".gif, .jpg, .png"/>
                      <label  for="image1">
                        <span>Set profile picture</span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username">
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                  </div>
                  <div class="form-group">
                      <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Confirm Password">
                  </div>
                   <div class="form-group">
                      <input type="email" class="form-control" id="exampleInputEmail4" placeholder="Email Address">
                  </div>
                  <hr/>
                  <div class="heading">
                    <h4 class="text-center">Personal information</h4>
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" id="exampleInputName5" placeholder="Full name">
                  </div>
                  <div class="form-group">
                      <input type="number" class="form-control" id="exampleInputPhone6" placeholder="Phone number">
                  </div>
                  <div class="form-group">
                      <input type="datepicker" class="form-control" id="exampleInputBirthday7" placeholder="Birthday">
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" id="exampleInputAddress8" placeholder="Address">
                  </div>
                  <div class="form-group">
                    <select class="form-control">
                      <option value="one">--Select country--</option>
                      <option value="Two">Indonesia</option>
                      <option value="Three">India</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-control">
                      <option value="one">--Select city--</option>
                      <option value="Two">Yogyakarta</option>
                      <option value="Three">Semarang</option>
                    </select>
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
