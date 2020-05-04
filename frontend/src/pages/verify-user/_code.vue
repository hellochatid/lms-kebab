<template>
  <div>{{ message }}</div>
</template>

<script>
import users from "~/services/users";

export default {
  layout: "main",
  data() {
    return {
      message: "verify user"
    };
  },
  mounted() {
    users
      .verifyUser(this, this.$route.params.code)
      .then(res => {
        if (res.error) {
          // TODO: show error message
          return;
        }
        this.message = "You have successfully verified your email address.";
      })
      .catch(err => {
        console.log(err.response);
      });
  }
};
</script>
