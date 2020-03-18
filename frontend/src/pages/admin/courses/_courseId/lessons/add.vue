<template>
  <div>
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="material-icons icon">playlist_add</i>
        </span>
        Add Lesson
        <small>#{{ course.title }}</small>
      </h3>
      <b-breadcrumb>
        <li class="breadcrumb-item">
          <NuxtLink to="/admin">Dashboard</NuxtLink>
        </li>
        <li class="breadcrumb-item">
          <NuxtLink to="/admin/courses">Courses</NuxtLink>
        </li>
        <li class="breadcrumb-item">
          <NuxtLink :to="'/admin/courses/' + course.id + '/lessons'">Lessons</NuxtLink>
        </li>
        <b-breadcrumb-item active>Add Lesson</b-breadcrumb-item>
      </b-breadcrumb>
    </div>
		<b-form @submit.stop.prevent="addLesson" ref="form">
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
            <b-form-group label="Title" label-for="title">
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
                rows="4"
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
            :to="'/admin/courses/' + course.id + '/lessons'"
            :class="disabledForm ? 'btn btn-danger btn-back disabled' : 'btn btn-danger btn-back'"
          >
            <i class="material-icons icon float-left">keyboard_backspace</i>
            Back
          </NuxtLink>
        </b-col>
        <b-col sm="4">
          <b-card header-tag="header" class="card-form">
            <h4 slot="header" class="card-title ">Featured Image</h4>
            <ImageUploader @changed="fileChanged" :reset="resetImage" />
          </b-card>
        </b-col>
      </b-row>
    </b-form>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import { ImageUploader } from "~/components/admin";
import form from "~/libs/form";
import courses from "~/services/courses";
import lessons from "~/services/lessons";

export default {
  head: {
    title: "Admin - Add Lesson"
  },
  layout: "admin",
  components: { ImageUploader },
  methods: {
    addLesson() {
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
      const fileImage = this.fileImage;
      if (fileImage !== null) {
        const formData = new FormData();
        formData.append("file", fileImage);
        formData.append("type", 'image');
        form
          .upload(this, formData)
          .then(response => {
            self.input.image = response.data.file_name;
            this.postLesson();
          })
          .catch(error => {
            console.log("error", error);
          });
      } else {
        this.postLesson();
      }
    },
    postLesson() {
      const self = this;
      const spinner = this.$refs.spinner;
      var alertText = "";
      lessons
        .add(this, this.input)
        .then(response => {
          alertText = "Lesson successfully added";
          spinner.classList.add("d-none");
          self.disabledForm = false;
          self.resetForm();
          form.alert(this.$store, alertText, 5, "success");
        })
        .catch(error => {
          alertText = "Oops something went wrong";
          spinner.classList.add("d-none");
          self.disabledForm = false;
          form.alert(this.$store, alertText, 5, "danger");
        });
    },
    fileChanged(image) {
      this.resetImage = false;
      this.fileImage = image.file;
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
      this.resetImage = true;
      this.$refs.form.reset();
    }
  },
  computed: mapGetters({
    adminUser: "users/adminUser",
    alert: "form/alert"
  }),
  data() {
    return {
      course: {
        id: "",
        title: ""
      },
      input: {
				course_id: this.$route.params.courseId,
        title: "",
        subtitle: "",
        description: "",
        image: "",
        tag: [],
        order: 0
      },
      tag: "",
      vueTags: [],
      fileImage: null,
      imageUrl: "",
      resetImage: false,
      disabledForm: false
    };
  },
  mounted() {
    this.resetAlert();
    const courseId = this.$route.params.courseId;
    courses.getById(this, courseId).then(data => {
      this.course.id = data.id;
      this.course.title = data.title;
    });
  }
};
</script>
