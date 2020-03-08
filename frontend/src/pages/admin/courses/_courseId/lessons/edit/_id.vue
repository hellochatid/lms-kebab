<template>
  <div>
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="material-icons icon">playlist_add</i>
        </span>
        Edit Lesson
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
        <b-breadcrumb-item active>Add Course</b-breadcrumb-item>
      </b-breadcrumb>
    </div>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import { ConfirmDelete, ImageUploader } from "~/components/admin";
import courses from "~/services/courses";
import lessons from "~/services/lessons";

export default {
  head: {
    title: "Admin - Pages"
  },
  layout: "admin",
  components: { ImageUploader },
  methods: {
    fileChanged(image) {
      console.log("ssss");
      // this.resetImage = false;
      // this.fileImage = image.file;
      // this.input.image = !image.remove ? this.fileName : "";
    }
  },
  data() {
    return {
      course: {
        id: "",
        title: ""
      }
    };
  },
  mounted() {
    const courseId = this.$route.params.courseId;
    const lessonId = this.$route.params.id;
    courses.getById(this, courseId).then(data => {
      this.course.id = data.id;
      this.course.title = data.title;
    });
    console.log(lessonId)
  }
};
</script>
