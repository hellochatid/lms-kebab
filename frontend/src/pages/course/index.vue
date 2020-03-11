<template>
  <div>

  <div class="row">
    <div class="col-sm-12 pt120">
      <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
        <h4 class="title float-left">Dashboard</h4>
        <ol class="breadcrumb float-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
      <div class="ff_one">
        <div class="icon"><span class="material-icons">assignment</span></div>
          <div class="detais">
          <p>Total course</p>
          <div class="timer">6</div>
        </div>
      </div>
    </div>
      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
      <div class="ff_one style2">
        <div class="icon"><span class="material-icons">check</span></div>
          <div class="detais">
          <p>Finished course</p>
          <div class="timer">1</div>
        </div>
      </div>
    </div>
      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
      <div class="ff_one style3">
        <div class="icon"><span class="material-icons">school</span></div>
          <div class="detais">
          <p>Score</p>
          <div class="timer">90</div>
        </div>
      </div>
    </div>
  </div>

  </div>

</template>

<script>
import { mapMutations, mapGetters } from "vuex";

export default {
  head: {
    title: "Dashboard | Student Course"
  },
  layout: "course"
};
</script>
