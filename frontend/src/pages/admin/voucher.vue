<template>
<div>

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="material-icons icon">confirmation_number</i>
    </span>
    Voucher
  </h3>
  <b-breadcrumb>
    <li class="breadcrumb-item">
      <NuxtLink to="/admin">Dashboard</NuxtLink>
    </li>
    <b-breadcrumb-item active>Voucher</b-breadcrumb-item>
  </b-breadcrumb>
</div>

<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
      
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
    title: "Voucher | Admin Kebab"
  },
  layout: "admin",
  computed: mapGetters({
    adminUser: "users/adminUser"
  })
};
</script>
