<template>
  <div>

    <section class="our-pricing pt140">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="main-title mb50">
              <h3 class="mt0">Payment</h3> 
            </div>
            <div class="heading mb-3">
              <p>Have a coupon? Type here to enter your code</p>
            </div>
            <div class="checkout_coupon ui_kit_button mb-3">
              <form class="form-inline form1">
                <input class="form-control mr-sm-4" type="search" placeholder="Coupon Code" aria-label="Search" style="height: 48px;">
                <button type="button" class="btn btn-primary">Apply Coupon</button>
              </form>
            </div>

            <div class="payment_widget text-left mb-3" style="margin-top: 72px;">
              <div class="ui_kit_checkbox style2">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="customCheck80">
                  <label class="custom-control-label" for="customCheck80">Direct bank transfer</label>
                </div>
                <div class="bt_details">
                  <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference.Your order will not be shipped until the funds have cleared in our account.</p>
                </div>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="customCheck82">
                  <label class="custom-control-label" for="customCheck82">Check payments</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="customCheck83">
                  <label class="custom-control-label" for="customCheck83">Cash on delivery</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="customCheck84">
                  <label class="custom-control-label" for="customCheck84">PayPal <img class="pr15" src="https://i.imgur.com/LX2kRSc.png" alt="payment.png"></label>
                </div>
              </div>
            </div>
            <div class="ui_kit_button payment_widget_btn">
              <a href="../course" class="btn btn-log btn-success" style="line-height: 2rem;">Place Order</a>
            </div>

          </div>
        </div>

      </div>
    </section>

  </div>

</template>

<script>
import { mapMutations, mapGetters } from "vuex";

export default {
  head: {
    title: "Payment | Student Course"
  },
  layout: "course"
};
</script>
