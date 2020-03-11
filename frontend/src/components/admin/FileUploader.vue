<template>
  <div>
    <div class="file-uploader">
      <span class="file-icon">
        <i class="material-icons icon">{{ fileIcon }}</i>
      </span>
      <span :id="name + '-file-name'" class="file-name no-file">No file selected</span>
      <div class="btn-upload">
        <label :for="'input-' + name" class="btn-primary">
          <input type="file" :id="'input-' + name" @change="selectFile" />
        </label>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "fileUploader",
  props: {
    name: String,
    type: String,
    allowed: String,
    maxSize: Number,
    value: String,
    reset: Boolean
  },
  watch: {
    reset: function(isReset) {
      if (isReset) {
        const elFileName = document.getElementById(this.name + "-file-name");
        elFileName.classList.add("no-file");
        elFileName.innerHTML = "No file selected";
        this.$emit("changed", { file: null });
      }
    }
  },
  methods: {
    selectFile() {
      const elFileName = document.getElementById(this.name + "-file-name");
      const inputFile = document.getElementById("input-" + this.name);
      const file = inputFile.files[0];

      elFileName.classList.remove("no-file");
      elFileName.innerHTML = file.name;

      this.$emit("changed", { file: file });
    }
  },
  data: function() {
    return {
      fileIcon: "attach_file",
      indexOfImage: null
    };
  },
  mounted: function() {
    switch (this.type) {
      case "document":
        this.fileIcon = "insert_drive_file";
        break;
      case "audio":
        this.fileIcon = "queue_music";
        break;
    }
  }
};
</script>

<style>
.file-uploader {
  height: calc(1.5em + 0.75rem + 12px);
  padding: 12px 0 12px 40px;
  font-size: inherit;
  border: 1px solid #ebedf2;
  position: relative;
}
.file-uploader:after {
  content: " ";
  display: table;
  clear: both;
}
.file-uploader .file-icon {
  width: 40px;
  height: inherit;
  position: absolute;
  top: 0;
  left: 0;

  text-align: center;
  display: inline-flex;
  justify-content: center;
  align-items: center;
}
.file-uploader .file-name.no-file {
  overflow: hidden;
  height: 28px;
  display: inline-block;
  white-space: nowrap;
  display: block;
  width: calc(100% - 52px);
  text-overflow: ellipsis;
}
.file-uploader .file-name.no-file {
  color: #ccc;
}
.file-uploader .file-icon .icon {
  color: rgba(187, 168, 191, 0.96078);
}
.file-uploader .btn-upload {
  width: 36px;
  height: 90%;
  position: absolute;
  top: 4px;
  right: 4px;
  z-index: 1;
}
.file-uploader .btn-upload.remove {
  right: 40px;
  top: 6px;
}
.file-uploader .btn-upload label {
  outline: 0;
  width: inherit;
  height: inherit;
  margin-bottom: 0;
  cursor: pointer;
  overflow: hidden;
  border-radius: 4px;
  -moz-transform: scale(-1, -1);
  -o-transform: scale(-1, -1);
  -webkit-transform: scale(-1, -1);
  transform: scale(-1, -1);

  -webkit-transition: all 0.3s ease;
  transition: all 0.3s ease;
}
.file-uploader .btn-upload.remove label {
  color: #ccc;
  -moz-transform: scale(1, 1);
  -o-transform: scale(1, 1);
  -webkit-transform: scale(1, 1);
  transform: scale(1, 1);
}
.file-uploader .btn-upload.remove label:hover {
  color: #aaa;
}
.file-uploader .btn-upload label:after {
  position: absolute;
  height: inherit;
  width: inherit;
  display: flex;
  justify-content: center;
  align-items: center;
  top: 0;
  left: 0;
  content: "";
  font-family: "Material Icons";
  font-weight: normal;
  font-style: normal;
  font-size: 20px;
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
.file-uploader .btn-upload label:after {
  content: "get_app";
}
.file-uploader .btn-upload.remove label:after {
  content: "delete";
}
.file-uploader .btn-upload label input,
.file-uploader .btn-upload label button {
  display: none;
  z-index: -99999;
  opacity: 0;
  position: absolute;
}
</style>
