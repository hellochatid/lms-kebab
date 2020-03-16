<template>
  <div>
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="material-icons icon">edit</i>
        </span>
        Edit Quiz
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
        <b-breadcrumb-item active>Edit Lesson</b-breadcrumb-item>
      </b-breadcrumb>
    </div>
    <b-form @submit.stop.prevent="editQuiz" ref="form">
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

      <b-card class="card-form">
        <b-form-group label="Question" label-for="question">
          <b-form-input
            v-model="input.question"
            id="question"
            type="text"
            :disabled="disabledForm"
            placeholder="Enter question"
          ></b-form-input>
        </b-form-group>

        <b-form-group label="Answer">
          <table>
            <tbody>
              <tr v-for="(answer, index) in input.answers" :key="index">
                <td>
                  <input :id="'answer-' + index" v-model="answer.value" />
                </td>
                <td>
                  <input
                    type="radio"
                    name="correct"
                    :checked="answer.correct"
                    :data-index="index"
                    v-on:change="setCorrectAnswer"
                  />
                </td>
                <td>
                  <button
                    v-if="index < (input.answers.length - 1)"
                    type="button"
                    :data-index="index"
                    @click="removeAnswer"
                  >Remove</button>
                  <button
                    v-if="index === (input.answers.length - 1)"
                    type="button"
                    @click="addAnswer"
                  >Add</button>
                </td>
              </tr>
            </tbody>
          </table>
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
    </b-form>
  </div>
</template>

<script>
import { mapMutations, mapGetters } from "vuex";
import { ImageUploader } from "~/components/admin";
import form from "~/libs/form";
import courses from "~/services/courses";
import lessons from "~/services/lessons";
import quiz from "~/services/quiz";

export default {
  head: {
    title: "Admin - Add Lesson"
  },
  layout: "admin",
  components: { ImageUploader },
  methods: {
    setCorrectAnswer(evt) {
      const currentChecked = this.input.answers.findIndex(
        v => v.correct === true
      );
      this.input.answers[currentChecked].correct = false;
      this.input.answers[evt.target.dataset.index].correct = evt.target.checked;
    },
    addAnswer() {
      this.input.answers.push({ id: null, value: "", correct: false });
    },
    removeAnswer(evt) {
      const index = evt.target.dataset.index;
      this.input.answers.splice(index, 1);
    },
    editQuiz() {
      const self = this;
      const spinner = this.$refs.spinner;

      // reset alert
      this.resetAlert();

      // validate form
      if (!form.validation({ question: "required" })) return;

      // disable form & show spinner
        spinner.classList.remove("d-none");
        this.disabledForm = true;

      // Post quiz
      this.postQuiz();
    },
    postQuiz() {
      const self = this;
      const spinner = this.$refs.spinner;
      var alertText = "";
      quiz
        .edit(this, this.$route.params.question_id)
        .then(response => {
          alertText = "Question successfully updated";
          spinner.classList.add("d-none");
          self.disabledForm = false;
          form.alert(this.$store, alertText, 5, "success");
        })
        .catch(error => {
          console.log(error);
          alertText = "Oops something went wrong";
          spinner.classList.add("d-none");
          self.disabledForm = false;
          form.alert(this.$store, alertText, 5, "danger");
        });
    },
    resetAlert() {
      form.alert(this.$store, "", 0, "default");
    }
  },
  computed: mapGetters({
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
        id: this.$route.params.question_id,
        lesson_id: this.$route.params.lesson_id,
        title: "",
        question: "",
        order: 0,
        answers: []
      },
      disabledForm: false
    };
  },
  mounted() {
    this.resetAlert();
    this.disabledForm = true;

    const courseId = this.$route.params.courseId;
    const lessonId = this.$route.params.lesson_id;
    const questionId = this.$route.params.question_id;

    this.input.title = "quiz " + courseId + "-" + lessonId;
    courses.getById(this, courseId).then(data => {
      this.course.id = data.id;
      this.course.title = data.title;
    });

    lessons.getById(this, lessonId).then(data => {
      this.lesson.id = data.id;
      this.lesson.title = data.title;
    });

    quiz.getById(this, questionId).then(data => {
      var answers = data.answers;

      answers.forEach(element => {
        var item = {
          id: element.id,
          value: element.answer,
          correct: element.correct_answer
        };
        this.input.answers.push(item);
      });

      this.input.question = data.question;
      this.disabledForm = false;
    });
  }
};
</script>
