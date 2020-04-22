<template>
	<div>
	<div class="col-sm-12 col-lg-12 col-xl-12" style="padding-top: 120px;">
		<div class="row">
			<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
				<div class="ff_one">
					<div class="icon">
						<span class="material-icons">receipt</span>
					</div>
					<div class="detais">
						<p>All invoice</p>
						<div class="timer">26</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
				<div class="ff_one style2">
					<div class="icon">
						<span class="material-icons">report</span>
					</div>
					<div class="detais">
						<p>Unpaid</p>
						<div class="timer">
							2
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
				<div class="ff_one style3">
					<div class="icon">
						<span class="material-icons">account_balance_wallet</span>
					</div>
					<div class="detais">
						<p>Paid</p>
						<div class="timer">24</div>
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
						<h4>Invoice</h4>
						<div class="grid">
							<div class="ui_kit_table">
								<table class="table">
									<thead class="thead-light">
								    	<tr>
								    		<th scope="col">No</th>
								    		<th scope="col">Invoice Number</th>
								    		<th scope="col">Invoice date</th>
								    		<th scope="col">Due date</th>
								    		<th scope="col">Status</th>
								    		<th scope="col">Total</th>
								    		<th scope="col">Action</th>
								    	</tr>
									</thead>
									<tbody>
								    	<tr>
								    		<td>1</td>
								    		<td>#415130</td>
								    		<td>21 Feb 2020</td>
								    		<td>28 Feb 2020</td>
								    		<td class="text-danger">Unpaid</td>
								    		<td>Rp 100.000</td>
								    		<td><a href="detail-invoice" class="btn btn-success btn-sm">Detail</a></td>
								    	</tr>
								    	<tr>
								    		<td>2</td>
								    		<td>#415131</td>
								    		<td>23 Jan 2020</td>
								    		<td>30 Jan 2020</td>
								    		<td class="text-success">Paid</td>
								    		<td>Rp 100.000</td>
								    		<td><a href="detail-invoice" class="btn btn-success btn-sm">Detail</a></td>
								    	</tr>
								    	<tr>
								    		<td>3</td>
								    		<td>#415132</td>
								    		<td>20 Des 2019</td>
								    		<td>27 Des 2019</td>
								    		<td class="text-success">Paid</td>
								    		<td>Rp 100.000</td>
								    		<td><a href="detail-invoice" class="btn btn-success btn-sm">Detail</a></td>
								    	</tr>
								    	<tr>
								    		<td>4</td>
								    		<td>#415133</td>
								    		<td>17 Nov 2019</td>
								    		<td>24 Nov 2019</td>
								    		<td class="text-success">Paid</td>
								    		<td>Rp 100.000</td>
								    		<td><a href="detail-invoice" class="btn btn-success btn-sm">Detail</a></td>
								    	</tr>
								    	<tr>
								    		<td>5</td>
								    		<td>#415134</td>
								    		<td>27 Oct 2019</td>
								    		<td>4 Nov 2019</td>
								    		<td class="text-success">Paid</td>
								    		<td>Rp 100.000</td>
								    		<td><a href="detail-invoice" class="btn btn-success btn-sm">Detail</a></td>
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

export default {
  head: {
    title: "Courses | Student Course"
  },
  layout: "course"
};
</script>
