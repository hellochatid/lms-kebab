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
            class="btn btn-gradient-primary btn-action btn-sm"
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
          <div v-for="lesson in lessons" :key="'lesson'+lesson.id">
            <b-card header-tag="header" class="card-list dragable">
              <div slot="header">
                <h6 class="handle list-title">{{ lesson.name }}</h6>
                <b-button
                  class="btn-icon btn-delete"
                  @click.stop="confirmDelete(lesson, $event.target)"
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
                        <small>50</small>
                      </h5>
                    </b-col>
                    <b-col sm="8" class="text-right">
                      <b-form-group id="input-group-1" label-for="title">
                        <b-button variant="primary" class="btn-action btn-sm">
                          <i class="material-icons icon">playlist_add</i>
                          <span>Add Material</span>
                        </b-button>
                        <b-button
                          v-b-toggle="'material-' + lesson.id"
                          variant="primary"
                          class="btn btn-action btn-visibility"
                        ></b-button>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-collapse :id="'material-' + lesson.id" visible>
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
                        <div v-for="material in lesson.materials" :key="'material'+material.id">
                          <b-card class="item card-list bordered handle">
                            <span>{{ material.title }}</span>
                            <b-button class="btn-icon btn-delete float-right">
                              <i class="material-icons icon">delete</i>
                            </b-button>
                            <b-button class="btn-icon btn-edit float-right">
                              <i class="material-icons icon">edit</i>
                            </b-button>
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
                        <small>({{ lessons.length }})</small>
                      </h5>
                    </b-col>
                    <b-col sm="6" class="text-right">
                      <b-form-group id="input-group-1" label-for="title">
                        <b-button variant="primary" class="btn-action btn-sm">
                          <i class="material-icons icon">settings</i>
                          <span>Add Quiz</span>
                        </b-button>
                        <b-button
                          v-b-toggle="'quiz-' + lesson.id"
                          variant="primary"
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
                        v-bind="dragMaterialsOptions"
                        :list="lesson.materials"
                        handle=".handle"
                        @end="dragEnd(lesson.materials)"
                      >
                        <div v-for="material in lesson.materials" :key="'material'+material.id">
                          <b-card class="item bordered handle">
                            <span>{{ material.title }}</span>
                            <b-button class="btn-icon btn-delete float-right">
                              <i class="material-icons icon">delete</i>
                            </b-button>
                            <b-button class="btn-icon btn-edit float-right">
                              <i class="material-icons icon">edit</i>
                            </b-button>
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
      const lessons = this.$store.getters["lessons/listItems"](this.course.id);
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
    confirmDelete(item, button) {
      this.ModalConfirmationData.id = item.id;
      this.ModalConfirmationData.title = "Confirm Deletion";
      this.ModalConfirmationData.content =
        'You are about to dalete "' + item.name + '"';
      this.$root.$emit("bv::show::modal", "modalConfirmation", button);
    },
    deleteData(evt) {
      lessons
        .delete(this, this.ModalConfirmationData.id)
        .then(() => {
          // delete success
        })
        .catch(error => {
          // console.log(error);
        });
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
        content: ""
      }
    };
  },
  mounted() {
    const courseId = this.$route.params.courseId;
    courses.getById(this, courseId).then(data => {
      this.course.id = data.id;
      this.course.title = data.title;
    });

    lessons.getListItems(this, courseId).then(data => {
      this.lessons = data;
    });
  }
};
</script>
