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
          <NuxtLink to="/admin/courses/add" class="btn btn-primary btn-action">
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
            <i class="material-icons icon">build</i>
            Manage lessons
          </NuxtLink>
        </template>
        <template v-slot:cell(actions)="data">
          <NuxtLink
            :to="'/admin/courses/edit/' + data.item.id"
            class="btn btn-outline-primary btn-sm"
          >
            <i class="material-icons icon">edit</i>
          </NuxtLink>

          <b-button
            variant="outline-danger"
            size="sm"
            @click.stop="confirmDelete(data.item.id, data.item.first_name, 'course', data.index, $event.target, '')"
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

    <ConfirmDelete :data="confirmDeleteData" :onDelete="deleteData" />
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import { ConfirmDelete } from "~/components/admin";
import courses from "~/services/courses";

export default {
  head: {
    title: "Admin - Pages"
  },
  layout: "admin",
  components: {
    ConfirmDelete
  },
  data() {
    return {
      items: [],
      fields: [
        { key: "index", label: "#", class: "width-30" },
        { key: "title", label: "Course" },
        { key: "lessons", label: "Lessons", class: "btn-default width-200" },
        { key: "actions", label: "Actions", class: "text-center btn-actions" }
      ],
      currentPage: 1,
      perPage: 10,
      totalRows: 4,
      confirmDeleteData: {
        id: "",
        title: "",
        item_deleted: "",
        model: ""
      }
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
    confirmDelete(id, item_deleted, model, index, button, title) {
      this.confirmDeleteData.id = id;
      this.confirmDeleteData.title =
        title !== "" ? title : "You are about to dalete";
      this.confirmDeleteData.item_deleted = item_deleted;
      this.confirmDeleteData.model = model;
      this.$root.$emit("bv::show::modal", "ModalconfirmDelete", button);
    },
    deleteData(evt) {
      console.log("deleted id", this.confirmDeleteData.id);
    }
  },
  mounted() {
    courses
      .get(this.$axios)
      .then(response => {
        this.items = response.data
      })
      .catch(error => {
        console.log(error);
      });
  }
};
</script>
