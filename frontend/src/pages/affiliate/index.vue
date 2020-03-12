<template>

<div class="col-sm-12 col-lg-12 col-xl-12" style="padding-top: 120px;">
	<div class="row">
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="ui_kit_message_box">
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					Please complete your information : bank account
					<span class="pull-right">
						<a class="btn btn-sm btn-success">Complete it</a>
						<a class="btn btn-sm btn-danger">Dismiss</a>
					</span>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="ui_kit_message_box">
				<div class="alert alert-card fade show" role="alert">
					<span class="material-icons inline">link</span> Your affiliate link 
					<span class="pull-right font-weight-bold">YNK45LB776 <a class="btn dbxshad btn-sm btn-thm white ml10">copy</a></span>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
			<div class="ff_one">
				<div class="icon">
					<span class="material-icons">person</span>
				</div>
				<div class="detais">
					<p>My Affiliate</p>
					<div class="timer">10</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-6 col-lg-6 col-xl-4">
			<div class="ff_one style2">
				<div class="icon">
					<span class="material-icons">person_add</span>
				</div>
				<div class="detais">
					<p>New affiliate</p>
					<div class="timer">
						1
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
					<p>Voucher quota</p>
					<div class="timer">20</div>
				</div>
			</div>
		</div>
		<div class="col-xl-12">
			<div class="application_statics">
				<h4>Your commision</h4>
					<div class="c_container">
						<div class="chart-container">
							<div class="chartjs-size-monitor">
								<div class="chartjs-size-monitor-expand">
									<div class=""></div>
								</div>
								<div class="chartjs-size-monitor-shrink">
									<div class=""></div>
								</div>
						</div>
						<canvas style="display: block; width: 943px; height: 471px;" width="943" height="471" class="chartjs-render-monitor"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-12 mt30 mb30">
			<div class="recent_job_activity">
			<h4 class="title">Notifications</h4>
			<div class="grid">
				<ul>
					<li><div class="title">Status Update</div></li>
					<li><p>This is an automated server response message. All systems are online.</p></li>
				</ul>
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
