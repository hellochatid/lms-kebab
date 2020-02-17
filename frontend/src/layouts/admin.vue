<template>
  <div>
    <div>
      <b-navbar
        toggleable="lg"
        type="light"
        variant="faded"
        fixed="top"
        class="default-layout-navbar"
      >
        <b-navbar class="navbar-brand-wrapper">
          <b-navbar-brand href="#">Kebab</b-navbar-brand>
        </b-navbar>

        <b-collapse id="nav-collapse" is-nav class="navbar-menu-wrapper">
          <b-navbar-nav>
            <b-nav-text>
              <span class="mdi-menu">
                <i class="material-icons">menu</i>
              </span>
            </b-nav-text>
          </b-navbar-nav>

          <!-- Right aligned nav items -->
          <b-navbar-nav class="ml-auto">
            <b-nav-item-dropdown right>
              <!-- Using 'button-content' slot -->
              <template v-slot:button-content>
                <div class="nav-profile-img">
                  <img src="../assets/images/faces/face1.jpg" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <span class="nav-profile-text">Hasan Sas</span>
              </template>
              <b-dropdown-item href="#">Profile</b-dropdown-item>
              <b-dropdown-item @click="logout">Sign Out</b-dropdown-item>
            </b-nav-item-dropdown>
          </b-navbar-nav>
        </b-collapse>
      </b-navbar>
    </div>

    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <b-nav vertical>
          <li class="nav-item active">
            <NuxtLink to="/admin" class="nav-link">
              <i class="material-icons icon">dashboard</i> Dashboard
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/admin" class="nav-link">
              <i class="material-icons icon">assignment</i> Courses
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/admin" class="nav-link">
              <i class="material-icons icon">supervisor_account</i> Affiliate
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/admin" class="nav-link">
              <i class="material-icons icon">local_library</i> Students
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/admin/pages" class="nav-link">
              <i class="material-icons icon">insert_drive_file</i> Pages
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/admin" class="nav-link">
              <i class="material-icons icon">web</i> Menus
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/admin" class="nav-link">
              <i class="material-icons icon">settings</i> Settings
            </NuxtLink>
          </li>
        </b-nav>
      </nav>
      <div class="main-panel">
        <div class="content-wrapper">
          <nuxt />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const Cookie = process.client ? require("js-cookie") : undefined;

export default {
  methods: {
    logout() {
      const authAdmin = {
        name: "",
        authenticated: false
      };
      Cookie.remove("authAdmin");
      this.$store.commit("users/setUserAdmin", authAdmin);
      this.$router.push({
        path: "/admin/login"
      });
    }
  }
};
</script>

<style>
/* general */
a {
  color: #FE8196;
  text-decoration: none;
  background-color: transparent;
}
a:hover {
  color: #18932C;
  text-decoration: underline;
}
.page-header{
  margin: 0 0 1.5rem 0;
}
.page-title {
  color: #343a40;
  font-size: 1.75rem;
  margin-bottom: 0;
}
.page-title .page-title-icon {
  display: inline-block;
  width: 36px;
  height: 36px;
  border-radius: 4px;
  text-align: center;
  -webkit-box-shadow: 0px 3px 8.3px 0.7px rgba(163, 93, 255, 0.35);
  box-shadow: 0px 3px 8.3px 0.7px rgba(254, 134, 150, 0.3);
}
.grid-margin, .purchase-popup {
  margin-bottom: 2.5rem;
}

/* cards */
.card {
  border: 0;
  background: #fff;
}
.card {
  position: relative;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  min-width: 0;
  word-wrap: break-word;
  background-color: #fff;
  background-clip: border-box;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 0.3125rem;
}
.card .card-body {
  padding: 2.5rem 2.5rem;
}
.card.card-img-holder .card-img-absolute {
  position: absolute;
  top: 0;
  right: 0;
  height: 100%;
}
.card .card-title {
  color: #343a40;
  margin-bottom: 0.75rem;
  text-transform: capitalize;
  font-family: "ubuntu-medium", sans-serif;
  font-size: 1.125rem;
  font-weight: bold;
}
.table-responsive {
  display: block;
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

/* table */
.table-responsive {
  display: block;
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}
.table {
  margin-bottom: 0;
  width: 100%;
  color: #212529;
  border-collapse: collapse;
}
.table thead th {
  border-top: 0;
  border-bottom-width: 1px;
  font-family: "ubuntu-medium", sans-serif;
  font-weight: initial;
  font-weight: bold;
  color: #fe8196;
}
table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #ebedf2;
}
table th, .table td {
  vertical-align: middle;
  font-size: 0.875rem;
  line-height: 1;
  white-space: nowrap;
}
.table th, .table td {
  padding: 0.9375rem;
  vertical-align: top;
  border-top: 1px solid #ebedf2;
}
th {
  text-align: inherit;
}
.table th img, .table td img {
  width: 36px;
  height: 36px;
  border-radius: 100%;
}

/* colors */
.bg-gradient-primary {
  background: -webkit-gradient(linear, left top, right top, from(#FE8196), to(#FFBE96)) !important;
  background: linear-gradient(to right, #FE8196, #FFBE96) !important;
  border: none;
}
.bg-gradient-danger {
  background: -webkit-gradient(linear, left top, right top, from(#ffbf96), to(#fe7096)) !important;
  background: linear-gradient(to right, #ffbf96, #fe7096) !important;
  border: none;
}
.bg-gradient-info {
  background: -webkit-gradient(linear, left top, right top, from(#90caf9), color-stop(99%, #047edf)) !important;
  background: linear-gradient(to right, #90caf9, #047edf 99%) !important;
  border: none;
}
.bg-gradient-success {
  background: -webkit-gradient(linear, left top, right top, from(#84d9d2), to(#07cdae)) !important;
  background: linear-gradient(to right, #84d9d2, #07cdae) !important;
  border: none;
}

/* navbar */
.navbar-light .navbar-brand {
  color: #FE8196;
  font-weight: bold;
  font-size: 1.5rem;
}
.navbar-light .navbar-brand:hover {
  color: #18932C;
}
.default-layout-navbar {
  padding: 0;
  background: #fff;
}
.navbar .navbar-brand-wrapper {
  transition: width 0.25s ease, background 0.25s ease;
  -webkit-transition: width 0.25s ease, background 0.25s ease;
  -moz-transition: width 0.25s ease, background 0.25s ease;
  -ms-transition: width 0.25s ease, background 0.25s ease;
  background: #fff;
  width: 260px;
  height: 70px;
  padding: 1rem 2rem;
}
.navbar .navbar-menu-wrapper {
  transition: width 0.25s ease;
  -webkit-transition: width 0.25s ease;
  -moz-transition: width 0.25s ease;
  -ms-transition: width 0.25s ease;
  color: #9c9fa6;
  padding-left: 24px;
  padding-right: 24px;
  width: calc(100% - 260px);
  height: 70px;
}
.navbar .mdi-menu i {
  margin-top: 8px;
  cursor: pointer;
}
.default-layout-navbar {
  padding: 0;
  box-shadow: 0px 3px 6px rgba(0,0,0,0.1);
}
.dropdown-menu{
  box-shadow: 0px 3px 6px rgba(0,0,0,0.1);
  border:none;
}
.nav-link.dropdown-toggle .nav-profile-img {
  position: relative;
  width: 32px;
  height: 32px;
  display: inline;
}
.nav-link.dropdown-toggle .nav-profile-img img {
  width: 32px;
  height: 32px;
  border-radius: 100%;
  margin-right: 6px;
}
.nav-profile-text {
  margin-right: 6px;
  color: #3e4b5b;
}

/* body wrapper */
.page-body-wrapper {
  padding-top: 70px;
  min-height: calc(100vh - 70px);
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  -ms-flex-direction: row;
  flex-direction: row;
  padding-left: 0;
  padding-right: 0;
}

/* sidebar */
.sidebar {
  min-height: calc(100vh - 70px);
  background: #ffffff;
  font-family: "ubuntu-regular", sans-serif !important;
  padding: 0;
  width: 260px;
  z-index: 11;
  transition: width 0.25s ease, background 0.25s ease;
  -webkit-transition: width 0.25s ease, background 0.25s ease;
  -moz-transition: width 0.25s ease, background 0.25s ease;
  -ms-transition: width 0.25s ease, background 0.25s ease;
}
.sidebar .nav-link:after {
  content: "";
  clear: both;
  display: block;
  overflow: hidden;
  visibility: hidden;
  width: 0;
  height: 0;
}
.sidebar .nav-link .icon {
  float: left;
  margin-right: 10px;
}
.nav-link{
  display: block;
  padding: 1rem 2rem;
}
.nav-link:hover{
  background:#fcfcfc;
}
.nav .nav-item a {
  color: #3e4b5b;
}
.nav .nav-item.active a{
  color: #FE8196;
}
.nav .nav-item.active a:hover{
  color: #18932C;
}

/* main panel */
.main-panel {
  -webkit-transition: width 0.25s ease, margin 0.25s ease;
  transition: width 0.25s ease, margin 0.25s ease;
  width: calc(100% - 260px);
  min-height: calc(100vh - 70px);
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
}
.content-wrapper {
  background: #f2edf3;
  padding: 2.75rem 2.25rem;
  width: 100%;
  -webkit-box-flex: 1;
  -ms-flex-positive: 1;
  flex-grow: 1;
}
</style>