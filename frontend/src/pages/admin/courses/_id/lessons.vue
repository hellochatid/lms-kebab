<template>
  <div>
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="material-icons icon">collections_bookmark</i>
        </span>
        Lessons
        <small>HTML & CSS</small>
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

    <b-row>
      <b-col sm="8">
        <draggable
          v-bind="dragLessonsOptions"
          :list="lessons"
          handle=".handle"
          @end="dragEnd(lessons)"
        >
          <div v-for="lesson in lessons" :key="'lesson'+lesson.id">
            <b-card header-tag="header" class="card-collapse">
              <div slot="header">
                <span class="handle">{{ lesson.name }}</span>
                <b-button class="btn-icon btn-delete">
                  <i class="material-icons icon">delete</i>
                </b-button>
                <b-button class="btn-icon btn-edit">
                  <i class="material-icons icon">edit</i>
                </b-button>
                <b-button v-b-toggle="'lesson-' + lesson.id" class="btn-collapse btn-icon"></b-button>
              </div>
              <b-collapse :id="'lesson-' + lesson.id">
                <div class="card-body-wrapper">
                  <b-row>
                    <b-col sm="4">
                      <h5 class="subhead">
                        <i class="material-icons icon">book</i>
                        Materials
                        <small>({{ lessons.length }})</small>
                      </h5>
                    </b-col>
                    <b-col sm="8" class="text-right">
                      <b-form-group id="input-group-1" label-for="title">
                        <b-button variant="primary" class="btn-action">
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
                        <b-button variant="primary" class="btn-action">
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
      </b-col>
      <b-col sm="4">
        <b-form>
          <b-card header-tag="header" footer-tag="footer" class="card-form">
            <div slot="header">
              <h5>Add Lesson</h5>
            </div>
            <b-form-group id="input-group-1" label-for="title">
              <b-form-input id="title" type="text" required placeholder="Title"></b-form-input>
            </b-form-group>
            <b-form-group id="input-group-2" label-for="subtitle">
              <b-form-input id="subtitle" type="text" required placeholder="Subtitle"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-3" label-for="description">
              <b-form-textarea id="description" placeholder="Description" rows="3"></b-form-textarea>
            </b-form-group>

            <b-form-group id="input-group-4" label-for="image">
              <b-form-file
                placeholder="Choose a file or drop it here..."
                drop-placeholder="Drop file here..."
              ></b-form-file>
            </b-form-group>

            <div slot="footer">
              <b-button type="submit" variant="primary">Submit</b-button>
              <b-button type="reset" variant="danger">Reset</b-button>
            </div>
          </b-card>
        </b-form>
      </b-col>
    </b-row>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import { ConfirmDelete, Navbar } from "~/components/admin";
import lessons from "~/services/lessons";

export default {
  head: {
    title: "Admin - Pages"
  },
  layout: "admin",
  data() {
    return {
      lessons: []
    };
  },
  methods: {
    dragEnd(items) {
      let option_ranks = [];
      items.forEach(el => {
        option_ranks.push(el.id);
      });
      console.log(option_ranks);
      // option_ranks  e.g.[10,20,30]
    }
  },
  computed: {
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
  async mounted() {
    this.lessons = await lessons.get();
  }
};
</script>
