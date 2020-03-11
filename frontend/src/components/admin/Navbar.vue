<template>
  <b-navbar toggleable="lg" type="light" variant="faded" fixed="top" class="default-layout-navbar">
    <b-navbar class="navbar-brand-wrapper">
      <b-navbar-brand href="#">
        <i class="material-icons icon">layers</i>
        <span>Kebab</span>
      </b-navbar-brand>
    </b-navbar>

    <b-collapse id="nav-collapse" is-nav class="navbar-menu-wrapper">
      <b-navbar-nav>
        <b-nav-text>
          <span class="mdi-menu" @click="toggleSidebar">
            <i class="material-icons">menu</i>
          </span>
        </b-nav-text>
      </b-navbar-nav>

      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto">
        <b-nav-item-dropdown right>
          <template v-slot:button-content>
            <div class="nav-profile-img">
              <img
                src="http://keenthemes.com/preview/metronic/theme/assets/layouts/layout5/img/avatar1.jpg"
                alt="image"
              />
              <span class="availability-status online"></span>
            </div>
            <span class="nav-profile-text">Hasan Sas</span>
          </template>
          <b-dropdown-item href="#">
            <i class="material-icons icon">person_outline</i>
            <span>Profile</span>
          </b-dropdown-item>
          <b-dropdown-item @click="logout">
            <i class="material-icons icon">exit_to_app</i>
            <span>Signout</span>
          </b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</template>

<script>
const Cookie = process.client ? require("js-cookie") : undefined;

export default {
  name: "navbar",
  methods: {
    toggleSidebar() {
      var body = document.body;
      var bodyClassName = "sidebar-icon-only";
      if (body.classList.contains(bodyClassName)) {
        body.classList.remove(bodyClassName);
      } else {
        body.classList.add(bodyClassName);
      }
    },
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
/*------------------------------------------*/
/*	   	navbar
/*------------------------------------------*/
.default-layout-navbar {
  padding: 0;
  background: #fff;
}
.sidebar-icon-only .navbar .navbar-brand-wrapper {
  width: 70px;
}
.sidebar-icon-only .nav-link {
  font-size: 10px;
  left: -24px;
  position: relative;
  text-align: center;
}
.sidebar-icon-only .sidebar .nav-link .icon {
  float: none;
  margin-right: 0px;
  font-size: 24px;
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
  color: #b66dff;
  font-weight: bold;
  font-size: 1.5rem;
}
.navbar-light .navbar-brand:hover {
  color: #a347ff;
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
.nav-profile-text {
  font-size: 1rem;
}
.navbar .mdi-menu i {
  margin-top: 8px;
  cursor: pointer;
}
.dropdown-toggle::after {
  border: 0;
  position: absolute;
  top: 16px;
  right: 0;

  content: "expand_more";
  font-family: "Material Icons";
  font-weight: normal;
  font-style: normal;
  font-size: 18px;
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
  color: #b66dff;
}
.navbar .navbar-nav .nav-profile-text {
  font-size: 0.9375rem;
  color: #000;
  padding-right: 8px;
  font-weight: 300;
}
.nav-link.dropdown-toggle .nav-profile-img {
  position: relative;
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
.dropdown-menu {
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
  border: none;
  top: 56px;
  padding: 0;
}
.dropdown-menu li:not(:last-child) {
  border-bottom: 1px solid #eee;
}
.dropdown-item {
  font-weight: 300;
  padding: 11px 13px;
}
.dropdown-item:after {
  content: " ";
  display: table;
  clear: both;
}
.dropdown-item .icon {
  color: rgba(187, 168, 191, 0.96078);
  float: left;
  margin-right: 10px;
}
</style>