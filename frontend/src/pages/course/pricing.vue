<template>
  <div>

    <section class="our-pricing pt140">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="main-title mb50">
              <h3 class="mt0">Let's start to learn</h3>
              <p>Change your future today with over 1.000 professional courses from the top industry<br/>leading teachers and professionals.</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="membership_container text-center">
              <ul class="row mc_parent_list">
                <li class="col-lg-4 list-inline-item">
                  <ul class="mc_child_list two text-center">
                    <li>
                      <div class="membership_header">
                        <div class="price">Rp 50.000 <span>/ month</span></div>
                        <h4>Silver</h4>
                      </div>
                    </li>
                    <li>Access to over 1.000 high quality courses. For individuals.</li>
                  </ul>
                  <div class="get-started">
                    <a href="../course/payment" class="btn btn-success">Get started</a>
                  </div>
                </li>
                <li class="col-lg-4 list-inline-item">
                  <ul class="mc_child_list three text-center">
                    <li>
                      <div class="membership_header">
                        <div class="price">Rp 100.000 <span>/ month</span></div>
                        <h4>Gold</h4>
                      </div>
                    </li>
                    <li>Starts with 3 accounts with more seats available.</li>
                  </ul>
                  <div class="get-started">
                    <a href="../course/payment" class="btn btn-success">Get started</a>
                  </div>
                </li>
                <li class="col-lg-4 list-inline-item">
                  <ul class="mc_child_list four text-center">
                    <li>
                      <div class="membership_header">
                        <div class="price">Rp 200.000 <span>/ month</span></div>
                        <h4>Platinum</h4>
                      </div>
                    </li>
                    <li>Build customized learning paths with content that aligns to your learning goals.</li>
                  </ul>
                  <div class="get-started">
                    <a href="../course/payment" class="btn btn-success">Get started</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>

</template>

<script>
import { mapMutations, mapGetters } from "vuex";

export default {
  head: {
    title: "Pricing Plan | Student Course"
  },
  layout: "course"
};
</script>
