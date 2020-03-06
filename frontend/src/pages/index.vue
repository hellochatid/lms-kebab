<template>
  <div>

  <section class="home-five bg-img5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="home5_slider">
            <div class="item">
              <div class="home-text">
                <h2>Learn to be <span class="text-thm">a Pro!</span></h2>
                <p>Find courses that will make you a reliable Chef with Head Chef of Turki Kebab franchise Baba Rafi, only in the Helocourse</p>
                <a class="btn home_btn" href="#">Try it now!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="our-courses" class="our-courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="main-title text-center">
            <h3 class="mt0">Why Choose Kebab Course?</h3>
            <p>Some reason why choose Kebab to learn to be a kebab master!</p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6 col-lg-3">
          <div class="img_hvr_box" style="background-image: url(https://i.imgur.com/PsYAyVS.png);">
            <div class="overlay">
              <div class="details">
                <h5>Personalized learning</h5>
                <p>Lessons adapt to your learning style. Quizes are tailored to help you learn effectively.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="img_hvr_box" style="background-image: url(https://i.imgur.com/H6bxxhQ.png);">
            <div class="overlay">
              <div class="details">
                <h5>Learn anywhere, anytime</h5>
                <p>Lessons is accessible with various device, desktop, mobile.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="img_hvr_box" style="background-image: url(https://i.imgur.com/2buhu6Y.png);">
            <div class="overlay">
              <div class="details">
                <h5>Tons of materials</h5>
                <p>There's a lot of material for your lesson, access to our exclusive video, audio and document file.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="img_hvr_box" style="background-image: url(https://i.imgur.com/nuiNzNf.png);">
            <div class="overlay">
              <div class="details">
                <h5>Affordable price</h5>
                <p>Offering an affordable price for you, you can select your plans based from your budget.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  </div>
</template>

<script>
import Logo from "~/components/Logo.vue";

export default {
  head: {
    title: "Kebab LMS"
  },
  components: {
    Logo
  },
  layout: "main",
};
</script>
