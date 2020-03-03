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
            <div class="upload-preview">
              <i class="material-icons icon">image</i>
              <div id="upload-preview-wrapper" class="upload-preview-wrapper"></div>
            </div>
          </div>
        </div>
      </div>
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
        btnRemove.classList.add("d-none");
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
      btnRemove.classList.remove("d-none");
      btnRemove.classList.remove("restore");
      btnRemove.classList.add("remove");
    },
    toggleRemoveImage() {
      const previewImageParent = document.getElementById(
        "upload-preview-wrapper"
      );
      const previewImage = document.getElementById("preview-image");
      const btnRemoveParent = document.getElementById("btn-upload-remove");
      if (previewImageParent.classList.contains("has-image")) {
        // remove preview
        previewImage.classList.add("d-none");
        previewImageParent.classList.remove("has-image");
        btnRemoveParent.classList.remove("remove");
        btnRemoveParent.classList.add("restore");
        this.$emit("changed", { file: null, remove: true });
      } else {
        // restore preview
        previewImage.classList.remove("d-none");
        previewImageParent.classList.add("has-image");
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
  }
};
</script>
