<template>
  <div>
    <b-navbar toggleable="lg" type="light" variant="faded" fixed="top">
      <div class="container">
        <b-navbar class="navbar-brand-wrapper">
          <b-navbar-brand href="/">
            <i class="material-icons icon">layers</i>
            <span>Kebab</span>
          </b-navbar-brand>
        </b-navbar>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
          <b-nav>
            <li class="nav-item">
              <NuxtLink to="/" class="nav-link">Home</NuxtLink>
            </li>
            <li class="nav-item">
              <NuxtLink to="/about" class="nav-link">About</NuxtLink>
            </li>
            <li class="nav-item">
              <NuxtLink to="/affiliate" class="nav-link">Affiliate</NuxtLink>
            </li>
            <li class="nav-item">
              <NuxtLink to="/course" class="nav-link">course</NuxtLink>
            </li>
          </b-nav>
        </b-navbar-nav>
      </div>
    </b-navbar>
    <div class="container">
      <div class="main-page">
        <nuxt />
      </div>
    </div>
    <footer>
      <div class="container">footer</div>
    </footer>
  </div>
</template>

<script>
import "~/assets/css/style.css";

export default {
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
