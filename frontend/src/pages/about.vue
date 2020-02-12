<template>
  <div class="container">
    <h1>About</h1>
    <p>
      <NuxtLink to="/about">
        About page
      </NuxtLink>
    </p>
    <p>
      <NuxtLink to="/users">
        Lists of users
      </NuxtLink>
    </p>
  </div>
</template>

<script>
export default {
  head: {
    title: "About",
    meta: [
      { hid: 'description', name: 'description', content: 'about page description' }
    ],
  }
};
</script>