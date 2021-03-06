<template>
  <div>
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="material-icons icon">collections_bookmark</i>
        </span>
        Lessons
        <small>#{{ course.title }}</small>
      </h3>
      <b-breadcrumb>
        <li class="breadcrumb-item">
          <NuxtLink to="/admin">Dashboard</NuxtLink>
        </li>
        <li class="breadcrumb-item">
          <NuxtLink to="/admin/courses">Courses</NuxtLink>
        </li>
        <b-breadcrumb-item active>Lessons</b-breadcrumb-item>
      </b-breadcrumb>
    </div>
    <b-card header-tag="header" class="card-table">
      <div slot="header">
        <div class="card-actions">
          <NuxtLink
            :to="'/admin/courses/' + course.id + '/lessons/add'"
            class="btn btn-gradient-primary btn-action"
          >
            <i class="material-icons icon">playlist_add</i>
            <span>Add Lesson</span>
          </NuxtLink>
        </div>
      </div>
      <div class="data-view">
        <draggable
          v-bind="dragLessonsOptions"
          :list="lessons"
          handle=".handle"
          @end="dragEnd(lessons)"
        >
          <div v-for="(lesson, index) in lessons" :key="'lesson'+lesson.id">
            <b-card header-tag="header" class="card-list dragable">
              <div slot="header">
                <b-media class="handle">
                  <template v-slot:aside>
                    <div class="mt-2 ml-2 mb-2 crop-square">
                      <b-img :src="lesson.image.url" :class="lesson.image.dimension"></b-img>
                    </div>
                  </template>
                  <h6 class="mt-3 list-title">{{ lesson.name }}</h6>
                  <p class="mb-0 mt-2 text-muted">
                    <span class="mr-3 text-danger">Materials ({{ lesson.materials.length }})</span>
                    <span class="mr-3 text-info">Quiz ({{ lesson.quiz.length }} questions)</span>
                    <!-- <small class="mr-3 mt-2 float-right">Duration 130m</small> -->
                  </p>
                </b-media>

                <b-button
                  class="btn-icon btn-delete"
                  @click.stop="confirmDelete(lesson, 'lesson', index)"
                >
                  <i class="material-icons icon">delete</i>
                </b-button>
                <NuxtLink
                  :to="'/admin/courses/' + course.id + '/lessons/edit/' + lesson.id"
                  class="btn btn-icon btn-edit"
                >
                  <i class="material-icons icon">edit</i>
                </NuxtLink>
                <b-button v-b-toggle="'lesson-' + lesson.id" class="btn-collapse btn-icon"></b-button>
              </div>
              <b-collapse :id="'lesson-' + lesson.id">
                <div class="card-body-wrapper">
                  <b-row>
                    <b-col sm="4">
                      <h5 class="subhead">
                        <i class="material-icons icon">book</i>
                        Materials
                        <small>({{ lesson.materials.length }})</small>
                      </h5>
                    </b-col>
                    <b-col sm="8" class="text-right">
                      <b-form-group id="input-group-1" label-for="title">
                        <NuxtLink
                          :to="'/admin/courses/' + course.id + '/lessons/' + lesson.id + '/add-material'"
                          class="btn btn-outline-info btn-action btn-sm"
                        >
                          <i class="material-icons icon">playlist_add</i>
                          <span>Add Material</span>
                        </NuxtLink>
                        <b-button
                          v-b-toggle="'material-' + lesson.id"
                          variant="outline-danger"
                          class="btn btn-action btn-visibility"
                        ></b-button>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-collapse :id="'material-' + lesson.id">
                    <b-form-group class="form-icon search">
                      <i class="material-icons icon">search</i>
                      <b-form-input id="search" type="text" placeholder="Search"></b-form-input>
                    </b-form-group>
                    <div class="material-items">
                      <draggable
                        v-bind="dragMaterialsOptions"
                        :list="lesson.materials"
                        handle=".handle"
                        @end="dragEnd(lesson.materials)"
                      >
                        <div
                          v-for="(material, indexMaterial) in lesson.materials"
                          :key="'material'+material.id"
                        >
                          <b-card class="item card-list bordered handle">
                            <span>{{ material.title }}</span>
                            <b-button
                              class="btn-icon btn-delete float-right"
                              @click.stop="confirmDelete(material, 'material', index, indexMaterial)"
                            >
                              <i class="material-icons icon">delete</i>
                            </b-button>
                            <NuxtLink
                              :to="'/admin/courses/' + course.id + '/lessons/' + lesson.id + '/edit-material/' + material.id"
                              class="btn-icon btn-edit float-right"
                            >
                              <i class="material-icons icon">edit</i>
                            </NuxtLink>
                          </b-card>
                        </div>
                      </draggable>
                    </div>
                  </b-collapse>
                  <b-row>
                    <b-col sm="6">
                      <h5 class="subhead">
                        <i class="material-icons icon">extension</i>
                        Quiz
                        <small>({{ lesson.quiz.length }} questions)</small>
                      </h5>
                    </b-col>
                    <b-col sm="6" class="text-right">
                      <b-form-group id="input-group-1" label-for="title">
                        <NuxtLink
                          :to="'/admin/courses/' + course.id + '/lessons/' + lesson.id + '/add-quiz'"
                          class="btn btn-outline-info btn-action btn-sm"
                        >
                          <i class="material-icons icon">playlist_add</i>
                          <span>Add Question</span>
                        </NuxtLink>
                        <b-button
                          v-b-toggle="'quiz-' + lesson.id"
                          variant="outline-danger"
                          class="btn btn-action btn-visibility"
                        ></b-button>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-collapse :id="'quiz-' + lesson.id">
                    <b-form-group class="form-icon search">
                      <i class="material-icons icon">search</i>
                      <b-form-input id="search" type="text" placeholder="Search"></b-form-input>
                    </b-form-group>
                    <div class="material-items">
                      <draggable
                        v-bind="dragQuizOptions"
                        :list="lesson.quiz"
                        handle=".handle"
                        @end="dragEnd(lesson.quiz)"
                      >
                        <div v-for="(quiz, indexQuiz) in lesson.quiz" :key="'quiz-'+quiz.id">
                          <b-card class="item bordered handle">
                            <span>{{ quiz.question }}</span>
                            <b-button
                              class="btn-icon btn-delete float-right"
                              @click.stop="confirmDelete(quiz, 'quiz', index, indexQuiz)"
                            >
                              <i class="material-icons icon">delete</i>
                            </b-button>
                            <NuxtLink
                              :to="'/admin/courses/' + course.id + '/lessons/' + lesson.id + '/edit-quiz/' + quiz.id"
                              class="btn-icon btn-edit float-right"
                            >
                              <i class="material-icons icon">edit</i>
                            </NuxtLink>
                          </b-card>
                        </div>
                      </draggable>
                    </div>
                  </b-collapse>
                </div>
              </b-collapse>
            </b-card>
          </div>
        </draggable>
      </div>
    </b-card>

    <ModalConfirmation :data="ModalConfirmationData" :onOK="deleteData" />
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import { ModalConfirmation } from "~/components/admin";
import courses from "~/services/courses";
import lessons from "~/services/lessons";
import materials from "~/services/materials";
import quiz from "~/services/quiz";

export default {
  head: {
    title: "Admin - Pages"
  },
  layout: "admin",
  components: { ModalConfirmation },
  computed: {
    ...mapGetters({
      lesson: "lessons/list"
    }),
    listItems() {
      const lessons = this.$store.getters["lessons/listByCourse"](
        this.course.id
      );
      return lessons;
    },
    dragLessonsOptions() {
      return {
        animation: 0,
        group: "lessons",
        disabled: false,
        ghostClass: "ghost"
      };
    },
    dragMaterialsOptions() {
      return {
        animation: 0,
        disabled: false,
        ghostClass: "ghost"
      };
    },
    dragQuizOptions() {
      return {
        animation: 0,
        disabled: false,
        ghostClass: "ghost"
      };
    }
  },
  methods: {
    dragEnd(items) {
      let lessonOrder = [];
      items.forEach(el => {
        lessonOrder.push(el.id);
      });

      lessons
        .setOrders(this, lessonOrder.toString())
        .then(() => {
          // update lesson orders success
        })
        .catch(error => {
          // console.log(error);
        });
    },
    confirmDelete(item, model, index, indexChild = null) {
      var content = "";
      switch (model) {
        case "material":
          content = item.title + '"';
          break;

        case "quiz":
          content = item.question + '"';
          break;

        default:
          content = item.name + '"';
          break;
      }

      this.ModalConfirmationData.model = model;
      this.ModalConfirmationData.index = index;
      this.ModalConfirmationData.indexChild = indexChild;
      this.ModalConfirmationData.id = item.id;
      this.ModalConfirmationData.title = "Confirm Deletion";
      this.ModalConfirmationData.content =
        'You are about to dalete "' + content;
      this.$root.$emit("bv::show::modal", "modalConfirmation");
    },
    deleteData(evt) {
      const self = this;
      const index = self.ModalConfirmationData.index;
      const indexChild = self.ModalConfirmationData.indexChild;

      switch (this.ModalConfirmationData.model) {
        case "material":
          materials
            .delete(this, this.ModalConfirmationData.id)
            .then(removedId => {
              const lsMaterial = this.lessons[index].materials;
              lsMaterial.splice(indexChild, 1);
            })
            .catch(error => {
              // console.log(error);
            });
          break;

        case "quiz":
          quiz
            .delete(this, this.ModalConfirmationData.id)
            .then(removedId => {
              const lsMaterial = this.lessons[index].quiz;
              lsMaterial.splice(indexChild, 1);
            })
            .catch(error => {
              // console.log(error);
            });
          break;

        default:
          lessons
            .delete(this, this.ModalConfirmationData.id)
            .then(removedId => {
              self.lessons.splice(index, 1);
            })
            .catch(error => {
              // console.log(error);
            });
          break;
      }
    }
  },
  data() {
    return {
      course: {
        id: "",
        title: ""
      },
      lessons: [],
      ModalConfirmationData: {
        id: "",
        title: "",
        content: "",
        model: "",
        index: null,
        indexChild: null
      }
    };
  },
  mounted() {
    const courseId = this.$route.params.courseId;
    courses.getById(this, courseId).then(data => {
      this.course.id = data.id;
      this.course.title = data.title;
    });

    lessons.getByCourse(this, courseId).then(data => {
      this.lessons = data;
    });
  }
};
</script>
