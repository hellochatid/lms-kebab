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
          :list="courses"
          handle=".handle"
          @end="dragEnd(courses)"
        >
          <div v-for="course in courses" :key="'course'+course.id">
            <b-card header-tag="header" class="card-collapse">
              <div slot="header">
                <span class="handle">{{ course.name }}</span>
                <b-button class="btn-icon btn-delete">
                  <i class="material-icons icon">delete</i>
                </b-button>
                <b-button class="btn-icon btn-edit">
                  <i class="material-icons icon">edit</i>
                </b-button>
                <b-button v-b-toggle="'lesson-' + course.id" class="btn-collapse btn-icon"></b-button>
              </div>
              <b-collapse :id="'lesson-' + course.id">
                <div class="card-body-wrapper">
                  <b-row>
                    <b-col sm="4">
                      <h5 class="subhead">
                        <i class="material-icons icon">book</i>
                        Materials
                        <small>({{ courses.length }})</small>
                      </h5>
                    </b-col>
                    <b-col sm="8" class="text-right">
                      <b-form-group id="input-group-1" label-for="title">
                        <b-button variant="primary" class="btn-action">
                          <i class="material-icons icon">playlist_add</i>
                          <span>Add Material</span>
                        </b-button>
                        <b-button
                          v-b-toggle="'material-' + course.id"
                          variant="primary"
                          class="btn btn-action btn-visibility"
                        ></b-button>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-collapse :id="'material-' + course.id" visible>
                    <b-form-group class="form-icon search">
                      <i class="material-icons icon">search</i>
                      <b-form-input id="search" type="text" placeholder="Search"></b-form-input>
                    </b-form-group>
                    <div class="material-items">
                      <draggable
                        v-bind="dragMaterialsOptions"
                        :list="course.materials"
                        handle=".handle"
                        @end="dragEnd(course.materials)"
                      >
                        <div v-for="material in course.materials" :key="'material'+material.id">
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
                        <small>({{ courses.length }})</small>
                      </h5>
                    </b-col>
                    <b-col sm="6" class="text-right">
                      <b-form-group id="input-group-1" label-for="title">
                        <b-button variant="primary" class="btn-action">
                          <i class="material-icons icon">settings</i>
                          <span>Add Quiz</span>
                        </b-button>
                        <b-button
                          v-b-toggle="'quiz-' + course.id"
                          variant="primary"
                          class="btn btn-action btn-visibility"
                        ></b-button>
                      </b-form-group>
                    </b-col>
                  </b-row>
                  <b-collapse :id="'quiz-' + course.id">
                    <b-form-group class="form-icon search">
                      <i class="material-icons icon">search</i>
                      <b-form-input id="search" type="text" placeholder="Search"></b-form-input>
                    </b-form-group>
                    <div class="material-items">
                      <draggable
                        v-bind="dragMaterialsOptions"
                        :list="course.materials"
                        handle=".handle"
                        @end="dragEnd(course.materials)"
                      >
                        <div v-for="material in course.materials" :key="'material'+material.id">
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

<style>
.card-collapse {
  margin-bottom: 10px;
}
.card-collapse .card-header {
  background: #fff;
  border: 0;
  position: relative;
  padding: 0;
}
.card-collapse .card-header span {
  display: block;
  padding: 12px 20px;
  cursor: pointer;
}
.card-collapse .card-body {
  padding: 0;
}
.card-header .btn-delete,
.card-header .btn-edit {
  position: absolute;
  top: 15px;
  z-index: 10;
}
.card-header .btn-delete {
  right: 80px;
}
.card-header .btn-edit {
  right: 120px;
}
.card-header .btn-collapse {
  position: absolute;
  right: 10px;
  top: 9px;
  z-index: 10;
}
.btn-collapse {
  width: 32px;
  height: 32px;
  padding: 0;
  line-height: 42px;
  position: relative;
}
.btn-collapse:before {
  content: "";
  height: 100%;
  width: 1px;
  background: #ccc;
  position: absolute;
  left: -10px;
  top: 0;
}
.btn-collapse:after {
  content: "expand_less";
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
.btn-collapse.collapsed:after {
  content: "expand_more";
}
.btn-visibility {
  position: relative;
  height: 38px;
  width: 38px;
}
.btn-visibility:after {
  position: absolute;
  top: 6px;
  left: 6px;
  content: "visibility_off";
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
.btn-visibility.collapsed:after {
  content: "visibility";
}
.card-body-wrapper {
  padding: 20px;
  border-top: 1px solid#ccc;
}
.subhead {
  padding: 4px 0;
}
.subhead:after {
  content: "";
  clear: both;
  display: block;
  overflow: hidden;
  visibility: hidden;
  width: 0;
  height: 0;
}
.subhead .icon {
  float: left;
  margin-right: 10px;
}
.subhead small {
  margin-left: 6px;
}
.form-icon {
  position: relative;
}
.form-icon input {
  font-size: 16px;
  border-radius: 0;
}
.form-icon .icon {
  position: absolute;
  right: 10px;
  top: 10px;
  color: #aaa;
  font-size: 20px;
}
.material-items {
  margin-bottom: 30px;
  max-height: 414px;
  overflow: auto;

  scrollbar-color: rgba(0, 0, 0, 0.3) rgba(0, 0, 0, 0.1); /* firefox */
  scrollbar-width: thin; /* firefox */
}
.material-items::-webkit-scrollbar {
  width: 16px !important;
  background-color: rgba(0, 0, 0, 0.1) !important;
  border-left: 10px transparent solid;
  background-clip: padding-box;
}
.material-items::-webkit-scrollbar-thumb {
  background-color: rgba(0, 0, 0, 0.3) !important;
  border-left: 10px transparent solid;
  background-clip: padding-box;
}
.item {
  margin-bottom: 10px;
  padding: 8px 15px;
}
.item:after {
  content: "";
  clear: both;
  display: block;
  overflow: hidden;
  visibility: hidden;
  width: 0;
  height: 0;
}
.item.bordered {
  border: 1px solid #ccc;
  background: #fafafa;
}
.item .btn-delete,
.item .btn-edit {
  margin-top: 2px;
  margin-left: 10px;
}
.btn-icon {
  padding: 0;
  line-height: 0;
  background: none;
  color: #aaa;
  border: 0;
}
.btn-icon:active,
.btn-icon:focus,
.btn-icon:hover {
  background: none !important;
  color: #666 !important;
  box-shadow: 0 0 0 rgba(255, 255, 255, 0) !important;
}

.btn-icon.inline {
  display: inline-block;
}
.btn-icon .icon {
  font-size: 20px;
}
</style>

<script>
import { mapMutations, mapGetters } from "vuex";

export default {
  middleware: "admin",
  head: {
    title: "Admin - Pages"
  },
  layout: "admin",
  data() {
    return {
      courses: [
        {
          id: 10,
          name: "Nulla leo erat lobortis ut sapien non",
          materials: [
            {
              id: 1,
              title: "aaaaaaa"
            },
            {
              id: 2,
              title: "bbb"
            },
            {
              id: 3,
              title: "ccc"
            },
            {
              id: 4,
              title: "ccc"
            },
            {
              id: 5,
              title: "ccc"
            },
            {
              id: 6,
              title: "ccc"
            },
            {
              id: 7,
              title: "ccc"
            },
            {
              id: 8,
              title: "ccc"
            },
            {
              id: 9,
              title: "ccc"
            },
            {
              id: 10,
              title: "ccc"
            },
            {
              id: 11,
              title: "ccc"
            },
            {
              id: 12,
              title: "ccc"
            },
            {
              id: 13,
              title: "ccc"
            }
          ]
        },
        {
          id: 20,
          name: "Sed placerat lacus non elit gravida accumsan",
          materials: [
            {
              id: 14,
              title: "ggg"
            },
            {
              id: 15,
              title: "jjjj"
            },
            {
              id: 16,
              title: "yyyy"
            }
          ]
        },
        {
          id: 30,
          name: "Quisque sed mollis ex",
          materials: []
        }
      ]
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
  }
};
</script>
