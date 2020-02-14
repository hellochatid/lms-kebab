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
          <b-navbar-brand href="#">AbcdeFgh</b-navbar-brand>
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
                <em>User</em>
              </template>
              <b-dropdown-item href="#">Profile</b-dropdown-item>
              <b-dropdown-item href="#">Sign Out</b-dropdown-item>
            </b-nav-item-dropdown>
          </b-navbar-nav>
        </b-collapse>
      </b-navbar>
    </div>

    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <b-nav vertical>
          <li class="nav-item">
            <NuxtLink to="/admin" class="nav-link">
              <i class="material-icons icon">dashboard</i> Dashboard
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/admin" class="nav-link">
              <i class="material-icons icon">spa</i> Courses
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/admin" class="nav-link">
              <i class="material-icons icon">card_membership</i> Affiliate
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/admin" class="nav-link">
              <i class="material-icons icon">people</i> Students
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/admin/pages" class="nav-link">
              <i class="material-icons icon">pages</i> Pages
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/admin" class="nav-link">
              <i class="material-icons icon">web</i> Menus
            </NuxtLink>
          </li>
          <li class="nav-item">
            <NuxtLink to="/admin" class="nav-link">
              <i class="material-icons icon">build</i> Settings
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

<style>
/* navbar */
.default-layout-navbar {
  padding: 0;
}
.navbar .navbar-brand-wrapper {
  transition: width 0.25s ease, background 0.25s ease;
  -webkit-transition: width 0.25s ease, background 0.25s ease;
  -moz-transition: width 0.25s ease, background 0.25s ease;
  -ms-transition: width 0.25s ease, background 0.25s ease;
  background: #fff;
  width: 260px;
  height: 70px;
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
  font-family: "ubuntu-regular", sans-serif;
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