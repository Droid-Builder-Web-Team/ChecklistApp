<template>
  <div class="user-avatar-uploader" @click="$refs.file.click()">
    <div v-if="avatarUrl">
      <img v-bind:src="avatarUrl" class="avatar" />
    </div>
    <div v-else>
      <div class="avatar no-avatar">No Avatar</div>
    </div>
    <input type="file" @change="onFileChanged" ref="file" class="hidden" />
  </div>
</template>

<script>

export default {
  props: ["avatar"],
  mounted: function () {
      this.avatarUrl = this.avatar
  },
  data() {
    return {
      selectedFile: null,
      avatarUrl: null
    };
  },
  methods: {
    onFileChanged(event) {
      this.selectedFile = event.target.files[0];
      this.url = URL.createObjectURL(this.selectedFile);
      console.log(this.selectedFile);
      console.log(this.url);
      this.avatarUrl = this.url;
    },
    onUploadClicked() {
      console.log("on upload");
      //   axios.post('my-domain.com/file-upload', this.selectedFile)
    },
    onUpload() {},
    onCancel() {
        this.avatarUrl = this.avatar;
    }
  }
};
</script>

<style lang="scss" scoped>

.user-avatar-uploader {
    &:hover {
        cursor: pointer;
    }
}

.hidden {
  display: none;
}
.uploader {
  &:hover {
    cursor: pointer;
  }
}

.avatar {
  height: 200px;
  width: 200px;
  border-radius: 50%;
}

.no-avatar {
  display: flex;
  justify-content: center;
  align-items: center;
  background: #888;
  color: #000;
  font-size: 1.1em;
}
</style>