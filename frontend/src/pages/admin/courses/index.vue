<template>
  <div>
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="material-icons icon">assignment</i>
        </span>
        Courses
      </h3>
      <b-breadcrumb>
        <li class="breadcrumb-item">
          <NuxtLink to="/admin">Dashboard</NuxtLink>
        </li>
        <b-breadcrumb-item active>Courses</b-breadcrumb-item>
      </b-breadcrumb>
    </div>

    <b-card header-tag="header" footer-tag="footer" class="card-table">
      <div slot="header">
        <div class="card-actions">
          <NuxtLink to="/admin/pages/add" class="btn btn-primary btn-action">
            <i class="material-icons icon">playlist_add</i>
            <span>Add Course</span>
          </NuxtLink>
        </div>
      </div>

      <b-table
        show-empty
        stacked="md"
        :items="items"
        :fields="fields"
        :current-page="currentPage"
        :per-page="perPage"
        :bordered="false"
        :outlined="false"
        @filtered="onFiltered"
      >
        <template v-slot:cell(index)="data">{{ (data.index + 1) + (currentPage - 1) * perPage}}</template>
        <template v-slot:cell(lessons)="data">
          <NuxtLink
            :to="'/admin/courses/' + data.item.id + '/lessons'"
            class="btn btn-outline-success btn-sm"
          >
            <i class="material-icons icon">settings</i>
            Manage lessons
          </NuxtLink>
        </template>
        <template v-slot:cell(actions)="data">
          <NuxtLink
            :to="'/admin/pages/edit/' + data.item.id"
            class="btn btn-outline-primary btn-sm"
          >
            <i class="material-icons icon">edit</i>
          </NuxtLink>

          <b-button
            variant="outline-danger"
            size="sm"
            @click.stop="info(data.item, data.index, $event.target)"
          >
            <i class="material-icons icon">delete</i>
          </b-button>
        </template>
      </b-table>

      <div slot="footer">
        <div class="pagination-group">
          <b-pagination
            :total-rows="items.length"
            :per-page="perPage"
            v-model="currentPage"
            prev-text="Prev"
            next-text="Next"
            hide-goto-end-buttons
          />
        </div>
      </div>
    </b-card>

    <!-- Info modal -->
    <b-modal
      id="modalInfo"
      centered
      size="md"
      @hide="resetModal"
      title="You are about to dalete"
      header-bg-variant="dark"
      header-text-variant="light"
      :no-close-on-backdrop="true"
      button-size="md"
      cancel-variant="secondary"
      ok-variant="primary"
      ok-title="Continue"
      @ok="deleteData"
    ></b-modal>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";

export default {
  middleware: "admin",
  head: {
    title: "Admin - Pages"
  },
  layout: "admin",
  data() {
    return {
      items: [
        { id: 5, age: 40, first_name: "Dickerson", last_name: "Macdonald" },
        { id: 6, age: 21, first_name: "Larsen", last_name: "Shaw" },
        { id: 7, age: 89, first_name: "Geneva", last_name: "Wilson" },
        { id: 8, age: 38, first_name: "Jami", last_name: "Carney" }
      ],
      fields: [
        { key: "index", label: "#", class: "width-30" },
        { key: "first_name", label: "Course" },
        { key: "lessons", label: "Lessons", class: "btn-default width-200" },
        { key: "actions", label: "Actions", class: "text-center btn-actions" }
      ],
      currentPage: 1,
      perPage: 3,
      totalRows: 4
    };
  },
  computed: mapGetters({
    userAdmin: "users/userAdmin"
  }),
  methods: {
    onFiltered(filteredItems) {
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    info(item, index, button) {
      this.$root.$emit("bv::show::modal", "modalInfo", button);
      console.log("infoooooo");
    },
    deleteData(evt) {
      console.log(evt);
    },
    resetModal() {
      this.modalInfo.title = "";
      this.modalInfo.content = "";
    }
  }
};
</script>
