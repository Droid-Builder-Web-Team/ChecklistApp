<template>
  <div class="user-avatar-uploader">
    <input type="file" @change="onFileChanged" ref="file" class="hidden" />
    <div class="avatar-editor" v-if="mode === 0">
      <div class="picker"></div>
      <img :src="avatarUrl" />
      <div class="buttons">
        <button type="button" class="btn btn-outline-primary mr-3" @click="onEdit()">Edit</button>
        <button type="button" class="btn btn-outline-danger" @click="onClear()">Remove</button>
      </div>
    </div>

    <div class="avatar-editor" v-else-if="mode === 1">
      <avatar-cropper :avatar="avatarUrl" v-on:change="onChange"></avatar-cropper>

      <div class="buttons" v-if="edit">
        <button
          type="button"
          class="btn btn-outline-primary mr-3"
          @click="$refs.file.click()"
        >Upload New...</button>
        <button type="button" class="btn btn-outline-secondary mr-3" @click="onCancel()">Cancel</button>
        <button type="button" class="btn btn-outline-primary" @click="onDone()">Done</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["avatar", "edit"],
  mounted: function () {
    this.avatarUrl = this.avatar;
  },
  data() {
    return {
      selectedFile: null,
      avatarUrl: null,
      originalAvatarUrl: null,
      mode: 0,
      cropped: null,
    };
  },
  mounted: function () {
    this.enforceAvatar();
    this.originalAvatarUrl = this.avatarUrl;
  },
  methods: {
    doEnterEdit() {
      this.mode = 1;
    },
    enforceAvatar() {
      if (!this.avatar || this.avatar.trim() === "") {
        this.avatarUrl = "/img/no-image.png";
      } else {
        this.avatarUrl = this.avatar;
      }
    },
    onFileChanged(event) {
      this.selectedFile = event.target.files[0];
      this.url = URL.createObjectURL(this.selectedFile);
      this.avatarUrl = this.url;
      this.mode = 1;
    },
    onEdit() {
      this.mode = 1;
    },
    onCancel() {
      this.avatarUrl = this.avatar;
    },
    onClear() {
      this.avatarUrl = "/img/no-image.png";
    },
    onCancel() {
      this.avatarUrl = this.originalAvatarUrl;
      this.mode = 0;
    },
    onChange(cropped) {
      console.log(cropped);
      this.cropped = cropped;
      console.log(this.cropped.toDataURL("image/png"));
    },
    onDone() {
      this.mode = 0;
      this.cropped.toBlob(
        (blob) => {
          let data = new FormData();
          data.append("avatar", blob);
          let settings = { headers: { "content-type": "multipart/form-data" } };
          axios
            .post("/avatar", data, settings)
            .then((response) => {
              console.log(response);
            })
            .catch((response) => {
              console.log(response);
            });
        },
        "image/jpeg",
        0.9
      );
    },
  },
};
</script>

<style lang="scss" scoped>
.user-avatar-uploader {
  position: relative;
}

.avatar {
  border-radius: 50%;
}

img {
  height: 250px;
  width: 250px;
  border-radius: 50%;
  vertical-align: middle;
}

.buttons {
  display: flex;
  justify-content: center;
  align-items: center;
  padding-top: 16px;
}

.hidden {
  display: none;
}
</style>