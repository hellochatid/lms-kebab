<template>
  <div>
    <div class="container">
      <nuxt />
    </div>
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