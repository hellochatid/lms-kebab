<template>
  <div>

    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="material-icons icon">dashboard</i>
        </span> 
        Student Dashboard 
      </h3>
    </div>

    <div class="row">
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
            <img src="../../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal mb-3">Course taken <i class="material-icons icon mdi-24px float-right">assignment</i></h4>
            <h2 class="mb-3">6</h2>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
          <div class="card-body">
            <img src="../../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal mb-3">Course finished <i class="material-icons icon mdi-24px float-right">flag</i></h4>
            <h2 class="mb-3">5</h2>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
          <div class="card-body">
            <img src="../../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal mb-3">Total score <i class="material-icons icon mdi-24px float-right">grade</i></h4>
            <h2 class="mb-3">9,0</h2>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 stretch-card grid-margin">
        <div class="board-wrapper">
          <div class="board-portlet m-0 full-width">
            <div class="clearfix mb-2">
              <h4 class="card-title float-left">Course list</h4>
            </div>
              <div class="row">
                <div class="col-md-3 grid-margin stretch-card">
                  <div class="card">
                    <div class="d-flex flex-row flex-wrap">
                      <img src="https://i2.wp.com/resepkoki.id/wp-content/uploads/2017/07/Resep-Kebab.jpg" class="img-lg rounded b-40" alt="profile image">
                      <div class="m-3">
                        <h6>Kebab Master with Baba Rafi</h6>
                        <small class="text-muted">Cheff Chenko</small>
                        <a class="btn btn-primary mt-2" href=""> Start course </a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-3 grid-margin stretch-card">
                  <div class="card">
                    <div class="d-flex flex-row flex-wrap">
                      <img src="https://i2.wp.com/resepkoki.id/wp-content/uploads/2017/07/Resep-Kebab.jpg" class="img-lg rounded b-40" alt="profile image">
                      <div class="m-3">
                        <h6>Kebab Master with Baba Rafi</h6>
                        <small class="text-muted">Cheff Chenko</small>
                        <a class="btn btn-primary mt-2" href=""> Start course </a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-3 grid-margin stretch-card">
                  <div class="card">
                    <div class="d-flex flex-row flex-wrap">
                      <img src="https://i2.wp.com/resepkoki.id/wp-content/uploads/2017/07/Resep-Kebab.jpg" class="img-lg rounded b-40" alt="profile image">
                      <div class="m-3">
                        <h6>Kebab Master with Baba Rafi</h6>
                        <small class="text-muted">Cheff Chenko</small>
                        <a class="btn btn-primary mt-2" href=""> Start course </a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-3 grid-margin stretch-card">
                  <div class="card">
                    <div class="d-flex flex-row flex-wrap">
                      <img src="https://i2.wp.com/resepkoki.id/wp-content/uploads/2017/07/Resep-Kebab.jpg" class="img-lg rounded b-40" alt="profile image">
                      <div class="m-3">
                        <h6>Kebab Master with Baba Rafi</h6>
                        <small class="text-muted">Cheff Chenko</small>
                        <a class="btn btn-primary mt-2" href=""> Start course </a>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
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
    title: "Course"
  },
  layout: "course"
};
</script>
