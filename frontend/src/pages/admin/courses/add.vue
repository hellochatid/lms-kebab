<template>
  <div>
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="material-icons icon">playlist_add</i>
        </span>
        Add Course
      </h3>
      <b-breadcrumb>
        <li class="breadcrumb-item">
          <NuxtLink to="/admin">Dashboard</NuxtLink>
        </li>
        <li class="breadcrumb-item">
          <NuxtLink to="/admin/courses">Courses</NuxtLink>
        </li>
        <b-breadcrumb-item active>Add Course</b-breadcrumb-item>
      </b-breadcrumb>
    </div>
    <b-form @submit.stop.prevent="addCourse" ref="form">
      <b-alert
        :show="alert.dismissCountDown"
        dismissible
        :variant="alert.variant"
        @dismissed="resetAlert"
      >
        <div slot="dismiss">
          <i class="material-icons icon">close</i>
        </div>
        <p>{{ alert.text }}</p>
      </b-alert>

      <b-row>
        <b-col sm="8">
          <b-card class="card-form">
            <b-form-group label="Title" label-for="title" description="Title">
              <b-form-input
                v-model="input.title"
                id="title"
                type="text"
                :disabled="disabledForm"
                placeholder="Enter title"
              ></b-form-input>
            </b-form-group>
            <b-form-group label="Subtitle" label-for="subtitle">
              <b-form-input
                v-model="input.subtitle"
                id="subtitle"
                type="text"
                :disabled="disabledForm"
                placeholder="Enter subtitle"
              ></b-form-input>
            </b-form-group>
            <b-form-group label="Description" label-for="description">
              <b-form-textarea
                v-model="input.description"
                id="description"
                :disabled="disabledForm"
                placeholder="Enter description"
                rows="3"
              ></b-form-textarea>
            </b-form-group>
            <b-form-group label="Tag" label-for="tag">
              <client-only>
                <vue-tags-input
                  id="tag"
                  v-model="tag"
                  :tags="vueTags"
                  :disabled="disabledForm"
                  @tags-changed="newTags => vueTags = newTags"
                />
              </client-only>
            </b-form-group>
          </b-card>
          <b-button type="submit" variant="primary">
            Submit
            <b-spinner ref="spinner" small class="float-right d-none" label="Floated Right"></b-spinner>
          </b-button>
          <NuxtLink to="/admin/courses" class="btn btn-danger btn-back">Back</NuxtLink>
        </b-col>
        <b-col sm="4">
          <b-card header-tag="header" class="card-form">
            <div slot="header">Featured Image</div>
            <label>
              <div class="upload-media">
                <span class="material-icons icon">insert_photo</span>
                <input type="file" id="file" ref="file" />
              </div>
            </label>
          </b-card>
        </b-col>
      </b-row>
    </b-form>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import courses from "~/services/courses";
import form from "~/libs/form";

export default {
  head: {
    title: "Admin - Add Course"
  },
  layout: "admin",
  methods: {
    addCourse() {
      const self = this;
      const spinner = this.$refs.spinner;

      // reset alert
      this.resetAlert();

      // validate form
      if (!form.validation({ title: "required" })) return;

      // disable form & show spinner
      spinner.classList.remove("d-none");
      this.disabledForm = true;

      // Get tags
      var tags = [];
      this.vueTags.forEach(element => {
        tags.push(element.text);
      });
      this.input.tag = tags.toString();

      // Post course
      const file = this.$refs.file.files[0];
      if (typeof file !== "undefined") {
        const formData = new FormData();
        formData.append("file", file);
        courses
          .uploadFile(this.$axios, formData)
          .then(response => {
            this.postCourse();
          })
          .catch(error => {
            console.log("error", error);
          });
      } else {
        this.postCourse();
      }
    },
    postCourse() {
      const self = this;
      const spinner = this.$refs.spinner;
      var alertText = "";
      courses
        .add(this.$axios, this.input)
        .then(response => {
          alertText = "Course successfully added";
          spinner.classList.add("d-none");
          self.disabledForm = false;
          self.resetForm();
          form.alert(this.$store, alertText, 5, "success");
        })
        .catch(error => {
          console.log("error");
          alertText = "Oops something went wrong";
          spinner.classList.add("d-none");
          self.disabledForm = false;
          form.alert(this.$store, alertText, 5, "danger");
        });
    },
    resetAlert() {
      form.alert(this.$store, "", 0, "default");
    },
    resetForm() {
      this.input.title = "";
      this.input.subtitle = "";
      this.input.description = "";
      this.input.image = "";
      this.input.tag = [];
      this.tag = "";
      this.tags = [];
      this.vueTags = [];
      this.$refs.form.reset();
    }
  },
  computed: mapGetters({
    userAdmin: "users/userAdmin",
    alert: "form/alert"
  }),
  data() {
    return {
      input: {
        title: "",
        subtitle: "",
        description: "",
        image: "",
        tag: []
      },
      tag: "",
      vueTags: [],
      tags: [],
      disabledForm: false
    };
  },
  mounted() {
    this.resetAlert();
  }
};
</script>

<style>
.ti-disabled .ti-tag {
  background: #bdbdbd;
}
.alert {
  position: relative;
}
.alert:before {
  position: absolute;
  top: 18px;
  left: 20px;
  content: "info";
  font-family: "Material Icons";
  font-weight: normal;
  font-style: normal;
  font-size: 24px;
  display: inline-block;
  line-height: 1;
  text-transform: none;
  letter-spacing: normal;
  word-wrap: normal;
  white-space: nowrap;
  direction: ltr;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
  -moz-osx-font-smoothing: grayscale;
  font-feature-settings: "liga";
}
.alert.alert-success:before {
  content: "done";
}
.alert.alert-danger:before {
  content: "error_outline";
}
.alert.alert-warning:before {
  content: "warning";
}
.alert.alert-info:before {
  content: "info";
}
.alert.alert-dismissible .close {
  top: 6px;
}
.alert.alert-dismissible .close .icon {
  font-size: 18px;
}
.alert p {
  margin: 0;
  padding: 6px 32px;
}
.form-error {
  border: 1px solid #ef9a9a !important;
  background: #ffebee;
}
.btn .spinner-border-sm {
  width: 22px;
  height: 22px;
  margin-left: 12px;
}
</style>