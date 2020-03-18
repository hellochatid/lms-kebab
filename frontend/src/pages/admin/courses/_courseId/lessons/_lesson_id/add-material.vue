<template>
  <div>
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="material-icons icon">playlist_add</i>
        </span>
        Add Material
        <small>#{{ lesson.title }}</small>
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
        <b-breadcrumb-item active>Add Material</b-breadcrumb-item>
      </b-breadcrumb>
    </div>
    <b-form @submit.stop.prevent="addMaterial" ref="form">
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

            <b-form-group id="input-group-3" label="Content" label-for="content">
              <TextEditor @changed="editorChanged" :reset="resetFormInput" />
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
            <h4 slot="header" class="card-title">PDF</h4>
            <FileUploader
              @changed="filePdfChanged"
              name="pdf"
              type="document"
              allowed="pdf"
              :maxSize="10"
              :reset="resetFormInput"
            />
          </b-card>

          <b-card header-tag="header" class="card-form">
            <h4 slot="header" class="card-title">Audio</h4>
            <FileUploader
              @changed="fileAudioChanged"
              name="audio"
              type="audio"
              allowed="mp3|ogg"
              :maxSize="10"
              :reset="resetFormInput"
            />
          </b-card>

          <b-card header-tag="header" class="card-form">
            <h4 slot="header" class="card-title">Featured Image</h4>
            <ImageUploader @changed="fileImageChanged" :reset="resetFormInput" />
          </b-card>
        </b-col>
      </b-row>
    </b-form>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import { ImageUploader, FileUploader, TextEditor } from "~/components/admin";
import form from "~/libs/form";
import courses from "~/services/courses";
import lessons from "~/services/lessons";
import materials from "~/services/materials";

export default {
  head: {
    title: "Admin - Add Lesson"
  },
  layout: "admin",
  components: { ImageUploader, FileUploader, TextEditor },
  methods: {
    editorChanged(value) {
      this.resetFormInput = false;
      this.input.content = value.content;
    },
    filePdfChanged(files) {
      this.resetFormInput = false;
      this.filePdf = files.file;
    },
    fileAudioChanged(files) {
      this.resetFormInput = false;
      this.fileAudio = files.file;
    },
    fileImageChanged(files) {
      this.fileImage = files.file;
    },
    resetAlert() {
      form.alert(this.$store, "", 0, "default");
    },
    async addMaterial() {
      const self = this;
      const spinner = this.$refs.spinner;
      
      // reset to default alert & form input
      this.resetAlert();
      // this.resetFormInput = false;

      // validate form
      if (!form.validation({ title: "required" })) return;

      // disable form & show spinner
      spinner.classList.remove("d-none");
      this.disabledForm = true;

      // upload pdf
      const filePdf = this.filePdf;
      if (filePdf !== null) {
        const formData = new FormData();
        formData.append("file", filePdf);
        formData.append("type", "document");

        const uploadPdf = await form.upload(this, formData);
        if (uploadPdf.success) {
          self.input.pdf = uploadPdf.data.file_name;
        }
      }

      // upload audio
      const fileAudio = this.fileAudio;
      if (fileAudio !== null) {
        const formData = new FormData();
        formData.append("file", fileAudio);
        formData.append("type", "audio");

        const uploadAudio = await form.upload(this, formData);
        if (uploadAudio.success) {
          self.input.audio = uploadAudio.data.file_name;
        }
      }

      // upload image
      const fileImage = this.fileImage;
      if (fileImage !== null) {
        const formData = new FormData();
        formData.append("file", fileImage);
        formData.append("type", "image");

        const uploadImage = await form.upload(this, formData);
        if (uploadImage.success) {
          self.input.image = uploadImage.data.file_name;
        }
      }

      // Post course
      this.postMaterial();
    },
    postMaterial() {
      const self = this;
      const spinner = this.$refs.spinner;
      var alertText = "";
      materials
        .add(this, this.input)
        .then(response => {
          alertText = "Material successfully added";
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
    resetForm() {
      this.input.title = "";
      this.input.subtitle = "";
      this.input.description = "";
      this.input.content = "";
      this.input.image = "";
      this.input.pdf = "";
      this.input.audio = "";
      this.input.video = "";
      this.resetFormInput = true;
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
      lesson: {
        id: "",
        title: ""
      },
      input: {
        lesson_id: this.$route.params.lesson_id,
        title: "",
        subtitle: "",
        description: "",
        content: "",
        image: "",
        pdf: "",
        audio: "",
        video: "",
        order: 0
      },
      tag: "",
      vueTags: [],
      filePdf: null,
      fileAudio: null,
      fileImage: null,
      imageUrl: "",
      resetFormInput: false,
      disabledForm: false
    };
  },
  mounted() {
    this.resetAlert();
    const courseId = this.$route.params.courseId;
    const lessonId = this.$route.params.lesson_id;

    courses.getById(this, courseId).then(data => {
      this.course.id = data.id;
      this.course.title = data.title;
    });

    lessons.getById(this, lessonId).then(data => {
      this.lesson.id = data.id;
      this.lesson.title = data.title;
    });
  }
};
</script>
