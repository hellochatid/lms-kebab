<template>
  <div>
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="material-icons icon">edit</i>
        </span>
        Edit Course
      </h3>
      <b-breadcrumb>
        <li class="breadcrumb-item">
          <NuxtLink to="/admin">Dashboard</NuxtLink>
        </li>
        <li class="breadcrumb-item">
          <NuxtLink to="/admin/courses">Courses</NuxtLink>
        </li>
        <b-breadcrumb-item active>Edit Course</b-breadcrumb-item>
      </b-breadcrumb>
    </div>
    <b-form @submit.stop.prevent="editCourse" ref="form">
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
          <b-button type="submit" variant="primary" :disabled="disabledForm">
            Submit
            <b-spinner ref="spinner" small class="float-right d-none" label="Floated Right"></b-spinner>
          </b-button>
          <NuxtLink
            to="/admin/courses"
            :class="disabledForm ? 'btn btn-danger btn-back disabled' : 'btn btn-danger btn-back'"
          >
            <i class="material-icons icon float-left">keyboard_backspace</i>
            Back
          </NuxtLink>
        </b-col>
        <b-col sm="4">
          <b-card header-tag="header" class="card-form">
            <h4 slot="header" class="card-title">Featured Image</h4>
            <ImageUploader :value="imageUrl" @changed="fileChanged" :reset="resetImage" />
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
import { ImageUploader } from "~/components/admin/";

export default {
  head: {
    title: "Admin - Add Course"
  },
  layout: "admin",
  components: { ImageUploader },
  methods: {
    editCourse() {
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
      const file = this.fileImage;
      if (file !== null) {
        const formData = new FormData();
        formData.append("file", file);
        courses
          .uploadFile(this.$axios, formData)
          .then(response => {
            self.input.image = response.data.file_name;
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
        .edit(this.$axios, this.input, this.$route.params.id)
        .then(response => {
          alertText = "Course successfully added";
          spinner.classList.add("d-none");
          self.disabledForm = false;
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
    fileChanged(image) {
      this.resetImage = false;
      this.fileImage = image.file;
      this.input.image = !image.remove ? this.fileName : "";
    },
    resetAlert() {
      form.alert(this.$store, "", 0, "default");
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
      fileImage: null,
      fileName: "",
      imageUrl: "",
      resetImage: false,
      disabledForm: false
    };
  },
  mounted() {
    const self = this;
    self.resetAlert();
    self.disabledForm = true;

    courses.getById(this.$axios, this.$route.params.id).then(data => {
      console.log(data);
      this.input.title = data.title;
      this.input.subtitle = data.subtitle;
      this.input.description = data.description;
      this.input.image = data.image.name;
      this.fileName = data.image.name;
      this.imageUrl = data.image.url;
      this.vueTags = data.tag.map(item => ({
        text: item,
        tiClasses: ["ti-valid"]
      }));
      self.disabledForm = false;
    });
  }
};
</script>
