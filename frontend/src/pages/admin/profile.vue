<template>

<div>

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="material-icons icon">person</i>
    </span> 
    Profile 
  </h3>
</div>

<div class="row">
	<div class="col-md-4 grid-margin stretch-card">

		<div class="card">
			<div class="card-body">
				<div class="d-flex flex-row flex-wrap">
				<img src="http://keenthemes.com/preview/metronic/theme/assets/layouts/layout5/img/avatar1.jpg" class="img-lg rounded" alt="profile image">
					<div class="ml-3">
						<h6>Hasan Sas</h6>
						<h6 class="text-muted">sas@babarafi.com</h6>
						<p class="mt-2 text-success font-weight-bold">Admin</p>
					</div>
				</div>
			</div>
		</div>
    <br/>
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <p class="mb-0 text-left">Branding</p>
            <div class="fluid-container">
              <h4 class="font-weight-medium text-right mb-0 text-muted">Baba Rafi</h4>
            </div>
          </div>
          <div class="float-right">
            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/2/23/Kebab_Turki_Baba_Rafi_Logo.jpg/250px-Kebab_Turki_Baba_Rafi_Logo.jpg">
          </div>
        </div>
      </div>
    </div>

	</div>
	<div class="col-md-8 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Detail info</h4>
				<div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <td width="20%" class="font-weight-bold">First name</td>
                <td>Hasan</td>
              </tr>
              <tr>
                <td width="20%" class="font-weight-bold">Last name</td>
                <td>Sas</td>
              </tr>
              <tr>
                <td width="20%" class="font-weight-bold">Email</td>
                <td>sas@babarafi.com</td>
              </tr>
              <tr>
                <td width="20%" class="font-weight-bold">Password</td>
                <td>******</td>
              </tr>
              <tr>
                <td width="20%" class="font-weight-bold">Phone number</td>
                <td>+62 8775 654 1100</td>
              </tr>
              <tr>
                <td width="20%" class="font-weight-bold">Address</td>
                <td>Jl. Kemerdekaan No.34, Gedongkuning</td>
              </tr>
              <tr>
                <td width="20%" class="font-weight-bold">City</td>
                <td>Yogyakarta</td>
              </tr>
              <tr>
                <td width="20%" class="font-weight-bold">Country</td>
                <td>Indonesia</td>
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
  data: {
    content: "Hello World!"
  },
  //middleware: "admin",
  head: {
    title: "Admin - Pages"
  },
  layout: "admin",
  computed: mapGetters({
    adminUser: "users/adminUser"
  })
};
</script>
