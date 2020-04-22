<template>
	<div>
	<div class="col-sm-12 col-lg-12 col-xl-12" style="padding-top: 120px;">
		<nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
		<h4 class="title float-left">Voucher</h4>
			<ol class="breadcrumb float-right">
				<li class="breadcrumb-item"><a href="../affiliate">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page">Voucher</li>
			</ol>
		</nav>
		<div class="row">
			<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
				<div class="ff_one">
					<div class="icon">
						<span class="material-icons">confirmation_number</span>
					</div>
					<div class="detais">
						<p>Voucher</p>
						<div class="timer">6</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
				<div class="ff_one style3">
					<div class="icon">
						<span class="material-icons">check_circle</span>
					</div>
					<div class="detais">
						<p>Active</p>
						<div class="timer">
							4
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
				<div class="ff_one style2">
					<div class="icon">
						<span class="material-icons">cancel</span>
					</div>
					<div class="detais">
						<p>Inactive</p>
						<div class="timer">2</div>
					</div>
				</div>
			</div>
				<div class="col-xl-12 mb30">
					<div class="application_statics">
						<span class="pull-right">
							<div class="form-group">
						    	<select class="form-control selectpicker mb-3">
									<option value="one">All</option>
									<option value="Two">Paid</option>
									<option value="Three">Unpaid</option>
								</select>
							</div>
						</span>
						<h4>Voucher</h4>
						<div class="grid">
							<div class="ui_kit_table">
								<table class="table">
									<thead class="thead-light">
								    	<tr>
								    		<th scope="col">No</th>
								    		<th scope="col">Name</th>
								    		<th scope="col">Value</th>
								    		<th scope="col">Expired date</th>
								    		<th scope="col">Status</th>
								    		<th scope="col">Action</th>
								    	</tr>
									</thead>
									<tbody>
								    	<tr>
								    		<td>1</td>
								    		<td>Discount New Student 20%</td>
								    		<td>20%</td>
								    		<td>28 Feb 2020</td>
								    		<td class="text-success">Active</td>
								    		<td><a href="detail-invoice" class="btn btn-danger btn-sm">Deactive</a></td>
								    	</tr>
								    	<tr>
								    		<td>2</td>
								    		<td>New Year , New Knowledge!</td>
								    		<td>50%</td>
								    		<td>30 Jan 2020</td>
								    		<td class="text-success">Active</td>
								    		<td><a href="detail-invoice" class="btn btn-danger btn-sm">Deactive</a></td>
								    	</tr>
								    	<tr>
								    		<td>3</td>
								    		<td>Voucher Discount to New Student</td>
								    		<td>Rp 20.000</td>
								    		<td>30 Jan 2020</td>
								    		<td class="text-success">Active</td>
								    		<td><a href="detail-invoice" class="btn btn-danger btn-sm">Deactive</a></td>
								    	</tr>
								    	<tr>
								    		<td>4</td>
								    		<td>Voucher Affiliate Specials</td>
								    		<td>50%</td>
								    		<td>30 Jan 2020</td>
								    		<td class="text-success">Active</td>
								    		<td><a href="detail-invoice" class="btn btn-danger btn-sm">Deactive</a></td>
								    	</tr>
								    	<tr>
								    		<td>5</td>
								    		<td>Discount New Student 20%</td>
								    		<td>20%</td>
								    		<td>30 Des 2020</td>
								    		<td class="text-danger">Inactive</td>
								    		<td><a href="detail-invoice" class="btn btn-success btn-sm">Activate</a></td>
								    	</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
								<nav aria-label="Page navigation">
								  <ul class="pagination pull-right">
								    <li>
								      <a href="#" aria-label="Previous">
								        <span aria-hidden="true">&laquo;</span>
								      </a>
								    </li>
								    <li><a href="#">1</a></li>
								    <li><a href="#">2</a></li>
								    <li><a href="#">3</a></li>
								    <li><a href="#">4</a></li>
								    <li><a href="#">5</a></li>
								    <li>
								      <a href="#" aria-label="Next">
								        <span aria-hidden="true">&raquo;</span>
								      </a>
								    </li>
								  </ul>
								</nav>
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
