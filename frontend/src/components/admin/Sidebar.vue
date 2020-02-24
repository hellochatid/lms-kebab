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
