<template>
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <b-nav vertical>
      <li class="nav-item active">
        <NuxtLink to="/admin" class="nav-link nav-dashboard">
          <i class="material-icons icon">dashboard</i> Dashboard
        </NuxtLink>
      </li>
      <li class="nav-item">
        <NuxtLink to="/admin/courses" class="nav-link">
          <i class="material-icons icon">assignment</i> Courses
        </NuxtLink>
      </li>
      <li class="nav-item">
        <NuxtLink to="/admin/affiliate" class="nav-link">
          <i class="material-icons icon">supervisor_account</i> Affiliate
        </NuxtLink>
      </li>
      <li class="nav-item">
        <NuxtLink to="/admin/affiliate" class="nav-link">
          <i class="material-icons icon">local_library</i> Students
        </NuxtLink>
      </li>
      <li class="nav-item">
        <NuxtLink to="/admin/pages" class="nav-link">
          <i class="material-icons icon">subject</i> Pages
        </NuxtLink>
      </li>
      <li class="nav-item">
        <NuxtLink to="/admin/affiliate" class="nav-link">
          <i class="material-icons icon">web</i> Menus
        </NuxtLink>
      </li>
      <li>
        <span v-b-toggle="'settings'" class="nav-link">
          <i class="material-icons icon">settings</i> Settings
        </span>
        <!-- Element to collapse -->
        <b-collapse id="settings">
          <NuxtLink to="/admin/ddd" class="nav-link">General</NuxtLink>
          <NuxtLink to="/admin/ggg" class="nav-link">Pricing Plan</NuxtLink>
        </b-collapse>
      </li>
    </b-nav>
  </nav>
</template>

<script>
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

<style scoped>
/*------------------------------------------*/
/*	   	Sidebar
/*------------------------------------------*/
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
.sidebar .nav-link {
  display: block;
  padding: 1rem 2rem;
  font-size: 15px;
}
.sidebar .nav-link:hover {
  background: #fcfcfc;
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
  font-size: 18px;
  margin-top: 2px;
  color: #bba8bff5;
}
.sidebar .nav-link {
  display: block;
  padding: 1rem 2rem;
  font-size: 15px;
}
.sidebar .nav-link:hover {
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
.nav .nav-item .nuxt-link-exact-active .icon,
.nav .nav-item .nav-dashboard.nuxt-link-exact-active {
  color: #b66dff;
}
.nav .nav-item .nuxt-link-active:hover,
.nav .nav-item .nuxt-link-exact-active:hover,
.nav .nav-item .nav-dashboard.nuxt-link-exact-active:hover {
  color: #a347ff;
}
</style>