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
          <b-dropdown-item href="#">Profile</b-dropdown-item>
          <b-dropdown-item @click="logout">Sign Out</b-dropdown-item>
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
