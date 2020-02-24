<template>
  <div>
    <Navbar />
    <div class="container-fluid page-body-wrapper">
      <Sidebar />
      <div class="main-panel">
        <div class="content-wrapper">
          <nuxt />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Navbar, Sidebar } from "../components/admin/";

export default {
  middleware: "admin",
  components: {
    Navbar,
    Sidebar
  },
  head() {
    return {
      link: [
        {
          rel: "stylesheet",
          href:
            "https://fonts.googleapis.com/css?family=Ubuntu:300i,400,500,700&display=swap"
        }
      ]
    };
  }
};
</script>

<style>
/* general */
body {
  font-family: "Ubuntu", sans-serif;
  color: #3e4b5b;
}
a {
  color: #fe8196;
  text-decoration: none;
  background-color: transparent;
}
a:hover {
  color: #db6075;
  text-decoration: underline;
}

/* Nuxt */
.nuxt-progress {
  background: #ef5350;
}

/* admin page */
.page-header {
  margin: 0 0 1.5rem 0;
}
.page-header:after {
  content: "";
  clear: both;
  display: block;
  overflow: hidden;
  visibility: hidden;
  width: 0;
  height: 0;
}
.page-header .page-title {
  float: left;
  color: #343a40;
  font-size: 1.75rem;
  margin-bottom: 0;
}
.page-header .page-title .page-title-icon {
  display: inline-block;
  width: 36px;
  height: 36px;
  border-radius: 4px;
  text-align: center;
  line-height: 36px;
  -webkit-box-shadow: 0px 3px 8.3px 0.7px rgba(163, 93, 255, 0.35);
  box-shadow: 0px 3px 8.3px 0.7px rgba(254, 134, 150, 0.3);
}
.page-header .page-title small {
  color: #757575;
  font-weight: 300;
}
.grid-margin,
.purchase-popup {
  margin-bottom: 2.5rem;
}
.btn-primary {
  color: #fff;
  background-color: #fe8196 !important;
  border-color: #fe8196 !important;
}

/* login */
.container-scroller {
  overflow: hidden;
}
.page-body-wrapper.full-page-wrapper {
  width: 100%;
  min-height: 100vh;
  background: #f2edf3;
}
.page-body-wrapper {
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
.container-fluid {
  width: 100%;
  padding-right: 20px;
  padding-left: 20px;
  margin-right: auto;
  margin-left: auto;
}
.content-wrapper {
  background: #f2edf3;
  padding: 2.75rem 2.25rem;
  width: 100%;
  -webkit-box-flex: 1;
  -ms-flex-positive: 1;
  flex-grow: 1;
}
.flex-grow {
  -webkit-box-flex: 1;
  -ms-flex-positive: 1;
  flex-grow: 1;
}
.auth .auth-form-light {
  background: #ffffff;
}
.auth .brand-logo {
  margin-bottom: 2rem;
  margin-bottom: 2rem;
  font-weight: bold;
  font-size: 2rem;
  color: #fe8196;
}
font-weight-light {
  font-weight: 300 !important;
}
.pt-3,
.py-3,
.card-revenue-table .revenue-item {
  padding-top: 1rem !important;
}
.auth form .form-group {
  margin-bottom: 1.5rem;
}
.auth form .form-group .form-control {
  background: transparent;
  border-radius: 0;
  font-size: 0.9375rem;
}
.form-control {
  border: 1px solid #ebedf2;
  font-size: 0.8125rem;
  display: block;
  width: 100%;
  font-weight: 400;
  color: #495057;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out,
    -webkit-box-shadow 0.15s ease-in-out;
}
.form-control-lg {
  height: 3.175rem;
  padding: 0.94rem 1.94rem;
  font-size: 1.25rem;
  line-height: 1.5;
  border-radius: 0.3rem;
}
.form-group input {
  width: 100%;
  padding: 0.5rem 1rem;
  border-radius: 6px;
  border: 1px #e1e1e1 solid;
}
.auth form .form-group {
  margin-bottom: 0.5rem;
}
.mt-24 {
  margin-top: 24px;
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
  font-size: 1.125rem;
  font-weight: 500;
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
  font-weight: initial;
  font-weight: 500;
  color: #fe8196;
}
table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #ebedf2;
}
table th,
.table td {
  vertical-align: middle;
  font-size: 0.875rem;
  line-height: 1;
  white-space: nowrap;
}
.table th,
.table td {
  padding: 0.9375rem;
  vertical-align: top;
  border-top: 1px solid #ebedf2;
}
th {
  text-align: inherit;
}
.table th img,
.table td img {
  width: 36px;
  height: 36px;
  border-radius: 100%;
}

/* colors */
.bg-gradient-primary {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#fe8196),
    to(#ffbe96)
  ) !important;
  background: linear-gradient(to right, #fe8196, #ffbe96) !important;
  border: none;
}
.bg-gradient-danger {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#ffbf96),
    to(#fe7096)
  ) !important;
  background: linear-gradient(to right, #ffbf96, #fe7096) !important;
  border: none;
}
.bg-gradient-info {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#90caf9),
    color-stop(99%, #047edf)
  ) !important;
  background: linear-gradient(to right, #90caf9, #047edf 99%) !important;
  border: none;
}
.bg-gradient-success {
  background: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#84d9d2),
    to(#07cdae)
  ) !important;
  background: linear-gradient(to right, #84d9d2, #07cdae) !important;
  border: none;
}

/* navbar */
.default-layout-navbar {
  padding: 0;
  background: #fff;
}
.sidebar-icon-only .navbar .navbar-brand-wrapper {
  width: 70px;
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
.navbar-brand .icon {
  float: left;
  margin: 6px 6px 0 0;
}
.navbar-light .navbar-brand {
  color: #fe8196;
  font-weight: bold;
  font-size: 1.5rem;
}
.navbar-light .navbar-brand:hover {
  color: #db6075;
}
.sidebar-icon-only .navbar-brand span {
  display: none;
}
.sidebar-icon-only .navbar .navbar-menu-wrapper {
  width: calc(100% - 70px);
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
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
}
.dropdown-menu {
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
  border: none;
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
.sidebar-icon-only .sidebar {
  width: 70px;
}
.sidebar {
  min-height: calc(100vh - 70px);
  background: #ffffff;
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
  font-size: 20px;
  margin-top: 2px;
}
.nav-link {
  display: block;
  padding: 1rem 2rem;
}
.nav-link:hover {
  background: #fcfcfc;
}
.nav .nav-item a {
  color: #3e4b5b;
  outline: 0;
}
.nav .nav-item a:hover,
.nav .nav-item .nav-dashboard.nuxt-link-active:hover {
  color: #29323d;
}
.nav .nav-item .nav-dashboard.nuxt-link-active {
  color: #3e4b5b;
}
.nav .nav-item .nuxt-link-active,
.nav .nav-item .nuxt-link-exact-active,
.nav .nav-item .nav-dashboard.nuxt-link-exact-active {
  color: #fe8196;
}
.nav .nav-item .nuxt-link-active:hover,
.nav .nav-item .nuxt-link-exact-active:hover,
.nav .nav-item .nav-dashboard.nuxt-link-exact-active:hover {
  color: #db6075;
}

/* main panel */
.sidebar-icon-only .main-panel {
  width: calc(100% - 70px);
}
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

/* rewrite bootstrap */
.breadcrumb {
  float: right;
  background: rgba(255, 255, 255, 0);
  margin: 0;
  padding: 6px 0;
}
.card-table .card-header,
.card-table .card-footer {
  background: #fff;
  border: 0;
}
.card-table .card-header:after,
.card-table .card-footer:after {
  content: "";
  clear: both;
  display: block;
  overflow: hidden;
  visibility: hidden;
  width: 0;
  height: 0;
}
.card-table .card-actions {
  float: right;
}
.card-table .card-body {
  padding: 0 1.25rem;
}
.card-table .table {
  border-width: 1px 0 1px 0;
  border-color: #dee2e6;
  border-style: solid;
  color: #3e4b5b;
}
.card-table .table .btn-actions {
  width: 100px;
}
.card-table .table .btn-actions .btn {
  width: 32px;
  height: 32px;
  padding: 0;
  line-height: 38px;
}
.card-table .table .btn-actions .btn .icon {
  font-size: 18px;
}

.card-table .table .btn-default .btn {
  padding: 0 8px !important;
  height: 32px;
  line-height: 30px;
}
.card-table .table .btn-default .btn .icon {
  font-size: 16px;
  float: left;
  margin: 6px 6px 0 0;
}
.pagination {
  margin: 0;
  float: right;
}
.card-form {
  margin-bottom: 20px;
}
.card-form .card-header {
  background: #fff;
}

/* Lessons */

.card-collapse {
  margin-bottom: 10px;
}
.card-collapse .card-header {
  background: #fff;
  border: 0;
  position: relative;
  padding: 0;
}
.card-collapse .card-header span {
  display: block;
  padding: 12px 20px;
  cursor: pointer;
}
.card-collapse .card-body {
  padding: 0;
}
.card-header .btn-delete,
.card-header .btn-edit {
  position: absolute;
  top: 15px;
  z-index: 10;
}
.card-header .btn-delete {
  right: 80px;
}
.card-header .btn-edit {
  right: 120px;
}
.card-header .btn-collapse {
  position: absolute;
  right: 10px;
  top: 9px;
  z-index: 10;
}
.btn-collapse {
  width: 32px;
  height: 32px;
  padding: 0;
  line-height: 42px;
  position: relative;
}
.btn-collapse:before {
  content: "";
  height: 100%;
  width: 1px;
  background: #ccc;
  position: absolute;
  left: -10px;
  top: 0;
}
.btn-collapse:after {
  content: "expand_less";
  font-family: "Material Icons";
  font-weight: normal;
  font-style: normal;
  font-size: 24px;
  display: inline-block;
  line-height: 1;
  text-transform: none;
  letter-spacing: normal;
  word-wrap: normal;
  white-space: nowrap;
  direction: ltr;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
  -moz-osx-font-smoothing: grayscale;
  font-feature-settings: "liga";
}
.btn-collapse.collapsed:after {
  content: "expand_more";
}
.btn-visibility {
  position: relative;
  height: 38px;
  width: 38px;
}
.btn-visibility:after {
  position: absolute;
  top: 6px;
  left: 6px;
  content: "visibility_off";
  font-family: "Material Icons";
  font-weight: normal;
  font-style: normal;
  font-size: 24px;
  display: inline-block;
  line-height: 1;
  text-transform: none;
  letter-spacing: normal;
  word-wrap: normal;
  white-space: nowrap;
  direction: ltr;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
  -moz-osx-font-smoothing: grayscale;
  font-feature-settings: "liga";
}
.btn-visibility.collapsed:after {
  content: "visibility";
}
.card-body-wrapper {
  padding: 20px;
  border-top: 1px solid#ccc;
}
.subhead {
  padding: 4px 0;
}
.subhead:after {
  content: "";
  clear: both;
  display: block;
  overflow: hidden;
  visibility: hidden;
  width: 0;
  height: 0;
}
.subhead .icon {
  float: left;
  margin-right: 10px;
}
.subhead small {
  margin-left: 6px;
}
.form-icon {
  position: relative;
}
.form-icon input {
  font-size: 16px;
  border-radius: 0;
}
.form-icon .icon {
  position: absolute;
  right: 10px;
  top: 10px;
  color: #aaa;
  font-size: 20px;
}
.material-items {
  margin-bottom: 30px;
  max-height: 414px;
  overflow: auto;

  scrollbar-color: rgba(0, 0, 0, 0.3) rgba(0, 0, 0, 0.1); /* firefox */
  scrollbar-width: thin; /* firefox */
}
.material-items::-webkit-scrollbar {
  width: 16px !important;
  background-color: rgba(0, 0, 0, 0.1) !important;
  border-left: 10px transparent solid;
  background-clip: padding-box;
}
.material-items::-webkit-scrollbar-thumb {
  background-color: rgba(0, 0, 0, 0.3) !important;
  border-left: 10px transparent solid;
  background-clip: padding-box;
}
.item {
  margin-bottom: 10px;
  padding: 8px 15px;
}
.item:after {
  content: "";
  clear: both;
  display: block;
  overflow: hidden;
  visibility: hidden;
  width: 0;
  height: 0;
}
.item.bordered {
  border: 1px solid #ccc;
  background: #fafafa;
}
.item .btn-delete,
.item .btn-edit {
  margin-top: 2px;
  margin-left: 10px;
}
.btn-icon {
  padding: 0;
  line-height: 0;
  background: none;
  color: #aaa;
  border: 0;
}
.btn-icon:active,
.btn-icon:focus,
.btn-icon:hover {
  background: none !important;
  color: #666 !important;
  box-shadow: 0 0 0 rgba(255, 255, 255, 0) !important;
}

.btn-icon.inline {
  display: inline-block;
}
.btn-icon .icon {
  font-size: 20px;
}

/* btn */

.btn-action .icon {
  float: left;
  margin-right: 6px;
}

/* Misc */
.width-30 {
  width: 30px;
}
.width-100 {
  width: 100px;
}
.width-200 {
  width: 200px;
}
</style>
