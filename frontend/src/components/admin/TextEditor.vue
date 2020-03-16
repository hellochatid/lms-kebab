<template>
  <div
    class="quill-editor"
    :content="content"
    @change="onEditorChange($event)"
    @blur="onEditorBlur($event)"
    @focus="onEditorFocus($event)"
    @ready="onEditorReady($event)"
    v-quill:myQuillEditor="editorOption"
  ></div>
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
  name: "textEditor",
  props: {
    name: String,
    value: String,
    reset: Boolean
  },
  watch: {
    reset: function(isReset) {
      if (isReset) {
        this.content = "";
        this.$emit("changed", { content: "" });
      }
    },
    value: function(value) {
      this.content = value;
    }
  },
  methods: {
    onEditorBlur(editor) {
      // console.log("editor blur!", editor);
    },
    onEditorFocus(editor, html) {
      // console.log("editor focus!", editor, html);
    },
    onEditorReady(editor) {
      // console.log("editor ready!", editor);
    },
    onEditorChange({ editor, html, text }) {
      this.content = html;
      this.$emit("changed", { content: html });
    }
  },
  data() {
    return {
      content: this.value,
      editorOption: {
        modules: {
          toolbar: toolbarOptions
        },
        placeholder: "Enter content"
      }
    };
  }
};
</script>

<style>
.quill-editor {
  min-height: 300px;
  max-height: 300px;
  overflow-y: auto;
}
.ql-toolbar.ql-snow {
  border-color: #ebedf2;
}
.ql-toolbar.ql-snow + .ql-container.ql-snow {
  border-color: #ebedf2;
}
.ql-snow .ql-tooltip {
  left: 1rem !important;
  top: 1rem !important;
}
</style>
