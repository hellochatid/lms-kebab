<template>
  <div>{{ slug }}</div>
</template>

<script>
export default {
  head() {
    return this.head;
  },
  layout: "main",
  data() {
    return {
      head: {
        title: "",
        meta: [
          {
            hid: "description",
            name: "description",
            content: "llll"
          }
        ]
      },
      slug: ""
    };
  },
  mounted() {
    this.head.title = this.$route.params.slug;
    this.slug = this.$route.params.slug;
  }
};
</script>