<template>
	<div>
	<div class="col-sm-12 col-lg-12 col-xl-12" style="padding-top: 120px;">
		<nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
		<h4 class="title float-left">Detail voucher</h4>
			<ol class="breadcrumb float-right"> 
				<li class="breadcrumb-item"><a href="../affiliate">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="../affiliate/voucher">Voucher</a></li>
				<li class="breadcrumb-item active" aria-current="page">Detail voucher</li>
			</ol>
		</nav>
		</div>
						<div class="col-lg-12 mb30">
							<div class="my_course_content_container">
								<div class="my_setting_content">
									<div class="my_setting_content_header">
										<div class="my_sch_title">
											<h4 class="m0 pull-right">Dicount value : 20%</h4>
											<h4 class="m0">Discount New Student 20%</h4>
										</div>
									</div>
									<div class="my_setting_content_details">
										<ul class="order_key_status mb0">
											<li>Expired date <span>28 Feb 2020</span></li>
											<li>Discount status <span class="text-success">Active</span></li>
										</ul>
									</div>
									<div class="my_setting_content_details">
										<div class="cart_page_form style3">
										<h4>Description</h4>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
										tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
										quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
										consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
										cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
										proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										<hr/>
										<h4>Terms and conditions</h4>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
										tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
										quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
										consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
										cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
										proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										<p>
											<a href="" class="text-danger pull-right">Deactive</a>
										</p>
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
    title: "Voucher Affiliate"
  },
  layout: "affiliate"
};

</script>
