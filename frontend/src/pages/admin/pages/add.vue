<template>
  <div>
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="material-icons icon">playlist_add</i>
        </span>
        Add Page
      </h3>
      <b-breadcrumb>
        <li class="breadcrumb-item">
          <NuxtLink to="/admin">Dashboard</NuxtLink>
        </li>
        <li class="breadcrumb-item">
          <NuxtLink to="/admin/pages">Pages</NuxtLink>
        </li>
        <b-breadcrumb-item active>Add Page</b-breadcrumb-item>
      </b-breadcrumb>
    </div>
    <b-row>
      <b-col sm="8">
        <b-card class="card-form">
          <b-form @submit="onSubmit" @reset="onReset">
            <b-form-group id="input-group-1" label="Title" label-for="title">
              <b-form-input id="title" type="text" required placeholder="Enter title"></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label="Description" label-for="description">
              <b-form-textarea id="textarea-rows" placeholder="Enter description" rows="3"></b-form-textarea>
            </b-form-group>

            <b-form-group id="input-group-3" label="Content" label-for="content">
              <div
                class="quill-editor"
                :content="content"
                @change="onEditorChange($event)"
                @blur="onEditorBlur($event)"
                @focus="onEditorFocus($event)"
                @ready="onEditorReady($event)"
                v-quill:myQuillEditor="editorOption"
              ></div>
            </b-form-group>

            <b-form-group
              id="input-group-4"
              label="Tag"
              label-for="tag"
              description="Separate with commas"
            >
              <b-form-input id="tag" type="text" required placeholder="Enter title"></b-form-input>
            </b-form-group>
          </b-form>
        </b-card>

        <b-button type="submit" variant="primary">Submit</b-button>
        <b-button type="reset" variant="danger">Reset</b-button>
      </b-col>
      <b-col sm="4">
        <b-card header-tag="header" class="card-form">
          <div slot="header">Publish</div>
          <b-form-checkbox
            id="checkbox-1"
            v-model="status"
            name="checkbox-1"
            value="accepted"
            unchecked-value="not_accepted"
          >Publish this page</b-form-checkbox>
        </b-card>
        <b-card header-tag="header" class="card-form">
          <div slot="header">Featured Image</div>
          <b-form-file
            placeholder="Choose a file or drop it here..."
            drop-placeholder="Drop file here..."
          ></b-form-file>
        </b-card>
      </b-col>
    </b-row>
  </div>
</template>

<script>
const toolbarOptions = [
  ["bold", "italic", "underline", "strike"],
  ["blockquote", "code-block"],
  [{ header: [1, 2, 3, 4, 5, 6, false] }],
  [{ list: "ordered" }, { list: "bullet" }],
  [{ script: "sub" }, { script: "super" }],
  [{ indent: "-1" }, { indent: "+1" }],
  [{ direction: "rtl" }],
  [{ align: [] }],
  ["link", "image", "video"]
];

export default {
  middleware: "admin",
  head: {
    title: "Admin - Add Page"
  },
  layout: "admin",
  data() {
    return {
      content: "",
      editorOption: {
        modules: {
          toolbar: toolbarOptions
        },
        placeholder: "Enter content"
      }
    };
  },
  mounted() {},
  methods: {
    onEditorBlur(editor) {
      console.log("editor blur!", editor);
    },
    onEditorFocus(editor) {
      console.log("editor focus!", editor);
    },
    onEditorReady(editor) {
      console.log("editor ready!", editor);
    },
    onEditorChange({ editor, html, text }) {
      console.log("editor change!", editor, html, text);
      this.content = html;
    }
  }
};
</script>

<style>
.container {
  width: 60%;
  margin: 0 auto;
  padding: 50px 0;
}
.quill-editor {
  min-height: 300px;
  max-height: 300px;
  overflow-y: auto;
}
</style>
