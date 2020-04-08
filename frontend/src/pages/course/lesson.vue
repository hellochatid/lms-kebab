<template>
  <div>

  <section class="our-team pb40 pt120">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-4 col-xl-4">
          <div class="row">
            <div class="col-lg-12">
              <div class="feature_course_widget">
                <ul class="list-group">
                  <h4 class="title" style="font-size:16px;margin-bottom:24px;">Kebab Master : Starting Business</h4>
                  <a href="#" class="list-group-item active">Menyapkan bahan bahan</a>
                  <a href="#" class="list-group-item">Basic ingredients</a>
                  <a href="#" class="list-group-item">Memasak yang baik dan benar</a>
                  <a href="#" class="list-group-item">Plating</a>
                  <a href="#" class="list-group-item">Marketing : Social Media Food Selling</a>
                  <a href="#" class="list-group-item last">Quiz</a>
                </ul>
              </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8 col-xl-8">
              <div class="instructor_pricing_widget">

              </div>
        </div>
      </div>
    </div>
  </section>

  </div>

</template>
<style>
.list-group-item.last{
  border-bottom:none;
}
</style>
<script>
import { mapMutations, mapGetters } from "vuex";

export default {
  head: {
    title: "Courses | Student Course"
  },
  layout: "course"
};
</script>
