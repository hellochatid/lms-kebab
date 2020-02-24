<template>
  <b-modal
    id="ModalconfirmDelete"
    centered
    size="md"
    header-bg-variant="dark"
    header-text-variant="light"
    button-size="md"
    cancel-variant="secondary"
    ok-variant="primary"
    ok-title="Continue"
    :no-close-on-backdrop="true"
    :title="data.title"
    @ok="onDelete"
  >
    <b>"{{ data.item_deleted }}"</b>
    from {{ data.model }}
  </b-modal>
</template>

<script>
export default {
  name: "confirmDelete",
  props: {
    data: Object,
    onDelete: Function
  }
};
</script>
