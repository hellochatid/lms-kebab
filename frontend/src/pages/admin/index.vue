<template>
  <div>

    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="material-icons icon">dashboard</i>
        </span> 
        Dashboard 
      </h3>
    </div>

    <div class="row">
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
            <img src="../../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal mb-3">Total Affiliate <i class="material-icons icon mdi-24px float-right">supervisor_account</i></h4>
            <h2 class="mb-3">1.456</h2>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
          <div class="card-body">
            <img src="../../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal mb-3">Total student <i class="material-icons icon mdi-24px float-right">local_library</i></h4>
            <h2 class="mb-3">1.400</h2>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
          <div class="card-body">
            <img src="../../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
            <h4 class="font-weight-normal mb-3">Total revenue <i class="material-icons icon mdi-24px float-right">account_balance_wallet</i></h4>
            <h2 class="mb-3">Rp 8.450.000</h2>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Top affiliate</h4>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th>Affiliate</th>
                    <th>Total income</th>
                    <th>This month</th>
                    <th>Last month</th>
                    <th>Form</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>
                      <img src="http://keenthemes.com/preview/metronic/theme/assets/layouts/layout5/img/avatar1.jpg" class="mr-2" alt="image"> David Grey </td>
                    <td>Rp 850.000</td>
                    <td class="font-weight-bold">Rp 80.000</td>
                    <td class="text-secondary">Rp 50.000</td>
                    <td><i class="material-icons icon text-success">arrow_upward</i></td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>
                      <img src="http://keenthemes.com/preview/metronic/theme/assets/layouts/layout5/img/avatar1.jpg" class="mr-2" alt="image"> Stella Johnson </td>
                    <td>Rp 750.000</td>
                    <td class="font-weight-bold">Rp 75.000</td>
                    <td class="text-secondary">Rp 50.000</td>
                    <td><i class="material-icons icon text-success">arrow_upward</i></td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>
                      <img src="http://keenthemes.com/preview/metronic/theme/assets/layouts/layout5/img/avatar1.jpg" class="mr-2" alt="image"> Marina Michel </td>
                    <td>Rp 650.000</td>
                    <td class="font-weight-bold">Rp 40.000</td>
                    <td class="text-secondary">Rp 66.000</td>
                    <td><i class="material-icons icon text-danger">arrow_downward</i></td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>
                      <img src="http://keenthemes.com/preview/metronic/theme/assets/layouts/layout5/img/avatar1.jpg" class="mr-2" alt="image"> John Doe </td>
                    <td>Rp 550.000</td>
                    <td class="font-weight-bold">Rp 45.000</td>
                    <td class="text-secondary">Rp 45.000</td>
                    <td><i class="material-icons icon text-secondary">drag_handle</i></td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>
                      <img src="http://keenthemes.com/preview/metronic/theme/assets/layouts/layout5/img/avatar1.jpg" class="mr-2" alt="image"> Stephany Wilson </td>
                    <td>Rp 450.000</td>
                    <td class="font-weight-bold">Rp 45.000</td>
                    <td class="text-secondary">Rp 45.000</td>
                    <td><i class="material-icons icon text-secondary">drag_handle</i></td>
                  </tr>
                </tbody>
              </table>
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
  middleware: "admin",
  head: {
    title: "Admin - Dashboard"
  },
  layout: "admin",
  computed: mapGetters({
    userAdmin: "users/userAdmin"
  }),
};
</script>