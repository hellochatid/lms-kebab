<template>
	<div>
						<div class="col-lg-12" style="padding-top: 120px;">
							<nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
								<h4 class="title float-left">Order detail</h4>
								<ol class="breadcrumb float-right">
							    	<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
							    	<li class="breadcrumb-item"><a href="#">Invoice</a></li>
							    	<li class="breadcrumb-item active" aria-current="page">Detail invoice</li>
								</ol>
							</nav>
						</div>
						<div class="col-lg-12 mb30">
							<div class="my_course_content_container">
								<div class="my_setting_content">
									<div class="my_setting_content_header">
										<div class="my_sch_title">
											<h4 class="m0">My Invoice</h4>
										</div>
									</div>
									<div class="my_setting_content_details">
										<ul class="order_key_status mb0">
											<li>Invoice No <span>#415130</span></li>
											<li>Order status <span class="text-danger">Unpaid</span></li>
										</ul>
									</div>
									<div class="my_setting_content_details">
										<div class="cart_page_form style3">
											<form action="#">
												<table class="table table-responsive">
												  	<thead>
													    <tr class="carttable_row">
													    	<th class="cartm_title" width="30%">Item</th>
													    	<th class="cartm_title">Invoice date</th>
													    	<th class="cartm_title">Due date</th>
													    	<th class="cartm_title">Quantity</th>
													    	<th class="cartm_title">Price</th>
													    	<th class="cartm_title">Amount</th>
													    </tr>
												  	</thead>
												  	<tbody class="table_body">
													    <tr>
													    	<th scope="row">
													    		<ul class="cart_list">
													    			<li class="list-inline-item"><a class="cart_title" href="#">Monthly subsciption : Normal package</a></li>
													    		</ul>
													    	</th>
													    	<td>21/2/20</td>
													    	<td>28/2/20</td>
													    	<td>1</td>
													    	<td class="cart_total">Rp 100.000</td>
													    	<td class="">Rp 100.000</td>
													    </tr>
													    <tr class="borderless_table_row">
													    	<th scope="row"></th>
													    	<td></td>
													    	<td></td>
													    	<td></td>
													    	<td class="cart_total color-dark fz18 pb10">Total</td>
													    	<td class="color-gray2 fz15 pb10">Rp 100.000</td>
													    </tr>
													    <tr class="borderless_table_row style2">
													    	<th scope="row"></th>
													    	<td></td>
													    	<td></td>
													    	<td></td>
													    	<td class="cart_total color-dark fz18 pt10">Total Paid</td>
													    	<td class="color-gray2 fz15 pt10">Rp 100.000</td>
													    </tr>
												  	</tbody>
												</table>
											</form>
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
    title: "Courses | Student Course"
  },
  layout: "course"
};
</script>
