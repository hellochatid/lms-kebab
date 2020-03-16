<template>
  <div>
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="material-icons icon">playlist_add</i>
        </span>
        Edit Material
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
        <b-breadcrumb-item active>Edit Material</b-breadcrumb-item>
      </b-breadcrumb>
    </div>
    <b-form @submit.stop.prevent="editMaterial" ref="form">
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
              <TextEditor @changed="editorChanged" :value="input.content" :reset="resetFormInput" />
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
              :value="input.pdf"
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
              :value="input.audio"
              :maxSize="10"
              :reset="resetFormInput"
            />
          </b-card>

          <b-card header-tag="header" class="card-form">
            <h4 slot="header" class="card-title">Featured Image</h4>
            <ImageUploader @changed="fileImageChanged" :reset="resetFormInput" :value="imageUrl" />
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
    async editMaterial() {
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
        .edit(this, this.$route.params.material_id)
        .then(response => {
          alertText = "Material successfully added";
          spinner.classList.add("d-none");
          self.disabledForm = false;
          form.alert(this.$store, alertText, 5, "success");
        })
        .catch(error => {
          alertText = "Oops something went wrong";
          spinner.classList.add("d-none");
          self.disabledForm = false;
          form.alert(this.$store, alertText, 5, "danger");
        });
    }
  },
  computed: mapGetters({
    userAdmin: "users/userAdmin",
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
        tag: "",
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
      fileVideo: null,
      fileImage: null,
      imageUrl: "",
      pdfUrl: "",
      audioUrl: "",
      videoUrl: "",
      resetFormInput: false,
      disabledForm: false
    };
  },
  mounted() {
    this.resetAlert();
    this.disabledForm = true;

    const courseId = this.$route.params.courseId;
    const lessonId = this.$route.params.lesson_id;
    const materialId = this.$route.params.material_id;

    courses.getById(this, courseId).then(data => {
      this.course.id = data.id;
      this.course.title = data.title;
    });

    lessons.getById(this, lessonId).then(data => {
      this.lesson.id = data.id;
      this.lesson.title = data.title;
    });

    materials.getById(this, materialId).then(data => {
      this.input.title = data.title;
      this.input.subtitle = data.subtitle;
      this.input.description = data.description;
      this.input.content = data.content;
      this.input.image = data.image.name;
      this.input.pdf = data.pdf.name;
      this.input.audio = data.audio.name;
      this.input.video = data.video.name;
      this.content = "data.content";
      this.imageUrl = data.image.url;
      this.pdfUrl = data.pdf.url;
      this.audioUrl = data.audio.url;
      this.videoUrl = data.video.url;
      this.disabledForm = false;
    });
  }
};
</script>
