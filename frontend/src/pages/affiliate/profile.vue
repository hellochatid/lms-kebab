<template>
<div>
						<div class="col-lg-12">
							<nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
								<h4 class="title float-left">User Profile</h4>
								<ol class="breadcrumb float-right">
							    	<li class="breadcrumb-item"><a href="#">Home</a></li>
							    	<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
								</ol>
							</nav>
						</div>
						<div class="col-lg-12">
							<div class="my_course_content_container">
								<div class="my_setting_content mb30">
									<div class="my_setting_content_header">
										<div class="my_sch_title">
											<h4 class="m0">Personal Details</h4>
										</div>
									</div>
									<div class="row my_setting_content_details pb0">
										<div class="col-xl-2">
											<img src="https://i.imgur.com/6XESUuX.jpg" class="img-profile">
										</div>
										<div class="col-xl-10">
											<div class="row">
												<div class="col-xl-4">
													<div class="my_profile_setting_input form-group">
												    	<label for="formGroupExampleInput1">First Name</label>
												    	<p>Hasan</p>
													</div>
													<div class="my_profile_setting_input form-group">
												    	<label for="formGroupExampleInput2">Occupation</label>
												    	<p>Student</p>
													</div>
												</div>
												<div class="col-xl-4">
													<div class="my_profile_setting_input form-group">
												    	<label for="formGroupExampleInput2">Last Name</label>
												    	<p>Saskeh</p>
													</div>
													<div class="my_profile_setting_input form-group">
												    	<label for="exampleInputPhone">Birthday</label>
												    	<p>21 January 1990</p>
													</div>
												</div>
												<div class="col-xl-4">
													<div class="my_profile_setting_input form-group">
												    	<label for="formGroupExampleInput2">Email</label>
												    	<p>hasansas@gmail.com</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="my_setting_content_header style2">
										<div class="my_sch_title">
											<h4 class="m0">Change password</h4>
										</div>
									</div>
									<div class="row my_setting_content_details pb0">
										<div class="col-xl-6">
											<div class="password_change_form">
												<form>
													<div class="form-group">
												    	<label for="exampleInputPassword1">Old Password</label>
												    	<input type="password" class="form-control" id="exampleInputPassword1" placeholder="*******">
													</div>
													<div class="form-group">
												    	<label for="exampleInputPassword2">New Password</label>
												    	<input type="password" class="form-control" id="exampleInputPassword2">
													</div>
													<div class="form-group">
												    	<label for="exampleInputPassword3">Confirm Password</label>
												    	<input type="password" class="form-control mb0" id="exampleInputPassword3">
													</div>
												</form>
											</div>
										</div>
									</div>
									<div class="my_setting_content_header style3">
										<div class="my_sch_title">
											<h4 class="m0">Social Links</h4>
										</div>
									</div>
									<div class="row my_setting_content_details">
									    <div class="col-xl-6">
									    	<div class="my_profile_setting_input2">
										      	<label for="validationServerUsername">Facebook</label>
										      	<div class="input-group">
										        	<input type="text" class="form-control" id="validationServerUsername" aria-describedby="inputGroupPrepend3" required>
										      	</div>
									    	</div>
									    </div>
									    <div class="col-xl-6">
									    	<div class="my_profile_setting_input2">
										      	<label for="validationServerUsername2">Twitter</label>
										      	<div class="input-group">
										        	<input type="text" class="form-control" id="validationServerUsername2" aria-describedby="inputGroupPrepend4" required>
										      	</div>
									    	</div>
									    </div>
									    <div class="col-xl-6">
									    	<div class="my_profile_setting_input2">
										      	<label for="validationServerUsername3">Linkedin</label>
										      	<div class="input-group">
										        	<input type="text" class="form-control" id="validationServerUsername3" aria-describedby="inputGroupPrepend4" required>
										      	</div>
									    	</div>
									    </div>
									    <div class="col-xl-6">
									    	<div class="my_profile_setting_input2">
										      	<label for="validationServerUsername4">Google Plus</label>
										      	<div class="input-group">
										        	<input type="text" class="form-control" id="validationServerUsername4" aria-describedby="inputGroupPrepend4" required>
										      	</div>
									    	</div>
									    </div>
									    <div class="col-lg-12">
											<button type="submit" class="my_setting_savechange_btn btn btn-thm">Save <span class="flaticon-right-arrow-1 ml15"></span></button>
									    </div>
									</div>
								</div>
							</div>
						</div>
						</div>  

</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import { ConfirmDelete } from "~/components/admin";
import courses from "~/services/courses";

export default {
  head: {
    title: "Affiliate"
  },
  layout: "affiliate"
};

</script>
