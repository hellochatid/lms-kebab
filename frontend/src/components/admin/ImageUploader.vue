<template>
  <div>
    <div :class="ratio !== '' ? 'square ' + ratio : 'square'">
      <div class="square-content">
        <div class="img-wrap">
          <div class="upload-image">
            <div class="btn-upload default">
              <label for="file-image" class="btn-primary">
                <input type="file" id="file-image" ref="file" @change="previewImage" />
              </label>
            </div>
            <div id="btn-upload-remove" class="btn-upload remove d-none">
              <label id="btn-image-remove" for="remove" class="btn-danger">
                <button type="button" id="remove" @click="toggleRemoveImage"></button>
              </label>
            </div>
            <div id="btn-upload-preview" class="btn-upload preview d-none">
              <label id="btn-image-preview" for="preview" class="btn-warning">
                <button type="button" id="preview" @click="indexOfImage = 0"></button>
              </label>
            </div>
            <div class="upload-preview">
              <i class="material-icons icon">image</i>
              <div id="upload-preview-wrapper" class="upload-preview-wrapper"></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- light gallery -->
    <div>
      <client-only>
        <v-gallery :images="images" :index="indexOfImage" @close="indexOfImage = null" />
      </client-only>
    </div>
  </div>
</template>

<script>
export default {
  name: "imageUploader",
  props: {
    value: String,
    reset: Boolean,
    ratio: String
  },
  watch: {
    reset: function(isReset) {
      if (isReset) {
        // Reset preview parent
        const previewImageParent = document.getElementById(
          "upload-preview-wrapper"
        );
        previewImageParent.innerHTML = "";
        previewImageParent.classList.remove("has-image");

        // Hide btn remove image
        const btnRemove = document.getElementById("btn-upload-remove");
        const btnPreview = document.getElementById("btn-upload-preview");
        btnRemove.classList.add("d-none");
        btnPreview.classList.add("d-none");

        // Light gallery preview image
        this.images = [];

        // Reset uploader
        this.$emit("changed", { file: null, remove: true });
      }
    },
    value: function(imageUrl) {
      this.setPreviewImage(imageUrl);
    }
  },
  methods: {
    previewImage() {
      const self = this;
      const reader = new FileReader();
      const file = self.$refs.file.files[0];

      reader.addEventListener(
        "load",
        function() {
          // preview image
          self.setPreviewImage(reader.result);

          // send prop to parent
          self.$emit("changed", { file: file, remove: false });
        },
        false
      );

      if (file) {
        reader.readAsDataURL(file);
      }
    },
    setPreviewImage(imageUrl) {
      // create image element
      const img = new Image();
      var dimension = "";

      img.src = imageUrl;
      dimension = img.width > img.height ? "landscape" : "potrait";
      dimension = img.width === img.height ? "square" : dimension;
      img.setAttribute("id", "preview-image");
      img.classList.add(dimension);

      // add has-image class to parent preview
      const previewImageParent = document.getElementById(
        "upload-preview-wrapper"
      );
      previewImageParent.innerHTML = "";
      previewImageParent.append(img);
      previewImageParent.classList.add("has-image");

      // Show btn remove image
      const btnRemove = document.getElementById("btn-upload-remove");
      const btnPreview = document.getElementById("btn-upload-preview");
      btnPreview.classList.remove("d-none");
      btnRemove.classList.remove("d-none");
      btnRemove.classList.remove("restore");
      btnRemove.classList.add("remove");

      // Light gallery preview image
      this.images = [imageUrl];
    },
    toggleRemoveImage() {
      const previewImageParent = document.getElementById(
        "upload-preview-wrapper"
      );
      const previewImage = document.getElementById("preview-image");
      const btnRemoveParent = document.getElementById("btn-upload-remove");
      const btnPreview = document.getElementById("btn-upload-preview");
      if (previewImageParent.classList.contains("has-image")) {
        // remove preview
        previewImage.classList.add("d-none");
        previewImageParent.classList.remove("has-image");
        btnPreview.classList.add("d-none");
        btnRemoveParent.classList.remove("remove");
        btnRemoveParent.classList.add("restore");
        this.$emit("changed", { file: null, remove: true });
      } else {
        // restore preview
        previewImage.classList.remove("d-none");
        previewImageParent.classList.add("has-image");
        btnPreview.classList.remove("d-none");
        btnRemoveParent.classList.add("remove");
        btnRemoveParent.classList.remove("restore");
        this.$emit("changed", {
          file:
            typeof this.$refs.file.files[0] !== "undefined"
              ? this.$refs.file.files[0]
              : null,
          remove: false
        });
      }
    }
  },
  data: function() {
    return {
      images: [],
      indexOfImage: null
    };
  }
};
</script>

<style>
/*------------------------------------------*/
/*	    Upload image
/*------------------------------------------*/
.upload-image {
  background: #eeeeee;
  border-radius: 4px;
  height: 100%;
  position: relative;
  overflow: hidden;
}
.upload-image:hover .btn-upload {
  right: 10px;
}
.upload-image .btn-upload {
  position: absolute;
  z-index: 100;
  right: -50px;
  width: 40px;
  height: 40px;
}
.upload-image .btn-upload.default {
  bottom: 10px;
  transition: all 0.2s ease-in-out;
}
.upload-image .btn-upload.remove {
  bottom: 58px;
  transition: all 0.4s ease-in-out;
}
.upload-image .btn-upload.restore {
  bottom: 58px;
  transition: all 0.4s ease-in-out;
}
.upload-image .btn-upload.preview {
  top: 10px;
  transition: all 0.4s ease-in-out;
}
.upload-image label {
  outline: 0;
  width: inherit;
  height: inherit;
  margin-bottom: 0;
  border-radius: 20px;
  cursor: pointer;
  overflow: hidden;
}
.upload-image label:after {
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
.upload-image .btn-upload.default label:after {
  content: "add_a_photo";
}
.upload-image .btn-upload.remove label:after {
  content: "delete";
}
.upload-image .btn-upload.restore label:after {
  content: "replay";
}
.upload-image .btn-upload.preview label:after {
  content: "fullscreen";
}
.upload-image label input,
.upload-image label button {
  display: none;
  z-index: -99999;
  opacity: 0;
  position: absolute;
}
.upload-image .upload-preview {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100%;
}
.upload-image .upload-preview .icon {
  font-size: 72px;
  color: #bdbdbd;
}
.upload-image .upload-preview .upload-preview-wrapper {
  width: 100%;
  height: inherit;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 10;
  transition: all 0.3s ease-in-out;
}
.upload-image:hover .upload-preview .upload-preview-wrapper {
  background: rgba(255, 255, 255, 0.5);
}
.upload-image .upload-preview .upload-preview-wrapper.has-image {
  background: #fff;
}
.upload-image .upload-preview .upload-preview-wrapper img {
  transition: all 0.3s ease-in-out;
}
.upload-image:hover .upload-preview .upload-preview-wrapper img {
  opacity: 0.5;
}
.btn-warning,
.btn-warning:focus,
.btn-warning:active,
.btn-warning:hover {
  color: #fff !important;
}

/* lght gallery */
.blueimp-gallery > .close {
  font-weight: 300;
}
</style>
