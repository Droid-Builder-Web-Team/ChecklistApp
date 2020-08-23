<template>
  <div>
    <input type="file" @change="onFileChanged" ref="file" class="hidden" />
    <div class="avatar-container mb-3">
      <vue-avatar :username="username" :src="originalAvatarUrl" :size="150"></vue-avatar>
    </div>
    <modal :adaptive="true" height="auto" name="avatar-cropper-modal" classes="modal-container">
      <h2 class="modal-title">Upload Avatar</h2>
      <div class="modal-contents">
        <div v-if="uploading" class="loader-container">
          <h3 class="mb-3">Uploading...</h3>
          <moon-loader color="#7BAABC" :loading="true" :size="150" sizeUnit="px"></moon-loader>
        </div>
        <vue-cropper
          v-else
          ref="cropper"
          :src="avatarUrl"
          :responsive="true"
          alt="Source Image"
          :aspectRatio="1"
        ></vue-cropper>
      </div>

      <div class="modal-buttons">
        <div class="flex-spacer"></div>
        <button class="btn btn-secondary mr-2" @click="doCancel()" :disabled="uploading">Cancel</button>
        <button class="btn btn-primary" @click="doSaveAndUpload()" :disabled="uploading">Upload</button>
      </div>
    </modal>
    <div class="d-flex justify-content-center">
      <button class="btn btn-outline-primary mr-3" @click="$refs.file.click()">Upload</button>
      <div class="flex-spacer"></div>
      <button class="btn btn-outline-secondary" @click="doClear()">Remove</button>
    </div>
  </div>
</template>

<script>
const VueAvatar = require("vue-avatar");

import VueCropper from "vue-cropperjs";
import "cropperjs/dist/cropper.css";

import { MoonLoader } from "@saeris/vue-spinners";

export default {
  props: ["avatar", "username"],
  components: { "vue-avatar": VueAvatar.default, VueCropper, MoonLoader },
  data: function () {
    return {
      avatarUrl: null,
      originalAvatarUrl: null,
      uploading: false,
    };
  },
  methods: {
    onFileChanged(event) {
      const selectedFile = event.target.files[0];
      this.avatarUrl = URL.createObjectURL(selectedFile);
      this.$modal.show("avatar-cropper-modal");
    },
    doCancel() {
      this.$modal.hide("avatar-cropper-modal");
    },
    doSaveAndUpload() {
      const image64 = this.$refs.cropper
        .getCroppedCanvas({
          width: 500,
          height: 500,
          maxHeight: 500,
          maxWidth: 500,
        })
        .toDataURL();
      this.avatarUrl = image64;

      const data = new FormData();
      data.append("avatar", image64);
      this.uploading = true;
      axios.post("/avatar", data).then(
        (response) => {
          setTimeout(
            function () {
              this.onUploadSuccess();
            }.bind(this),
            2000
          );
        },
        (error) => {
          this.onUploadFailed();
        }
      );
    },
    doClear() {
      axios.post("/avatar", {}).then(
        (response) => {
          this.avatarUrl = null;
          this.originalAvatarUrl = null;
          this.onUploadSuccess();
        },
        (error) => {
          this.onUploadFailed();
        }
      );
    },
    onUploadSuccess() {
      this.doCancel();
      this.originalAvatarUrl = this.avatarUrl;
      let toast = this.$toasted.show("Avatar Updated!", {
        theme: "toasted-primary",
        position: "bottom-center",
        duration: 3000,
        action: {
          text: "Dismiss",
          onClick: (e, toastObject) => {
            toastObject.goAway(0);
          },
        },
      });
    },
    onUploadFailed() {
      this.uploading = false;
      this.avatarUrl = null;
      this.originalAvatarUrl = null;
      let toast = this.$toasted.show("Couldn't Update Avatar", {
        theme: "toasted-primary",
        position: "bottom-center",
        duration: 3000,
        action: {
          text: "Dismiss",
          onClick: (e, toastObject) => {
            toastObject.goAway(0);
          },
        },
      });
    },
  },
  mounted() {
    this.avatarUrl = this.avatar;
    this.originalAvatarUrl = this.avatar;
    this.uploading = false;
  },
};
</script>

<style lang="scss" scoped>
.avatar-container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 160px;
  height: 160px;
  background: #fff;
  border-radius: 50%;
}

.loader-container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}
</style>
