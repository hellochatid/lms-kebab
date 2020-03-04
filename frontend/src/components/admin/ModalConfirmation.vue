<template>
  <b-modal
    id="modalConfirmation"
    centered
    size="md"
    header-bg-variant="light"
    header-text-variant="dark"
    button-size="md"
    cancel-variant="light"
    ok-variant="primary"
    ok-title="Continue"
    :no-close-on-backdrop="true"
    :title="data.title"
    @ok="onOK"
  >{{ data.content }}</b-modal>
</template>

<script>
export default {
  name: "modalConfirmation",
  props: {
    data: Object,
    onOK: Function
  }
};
</script>
