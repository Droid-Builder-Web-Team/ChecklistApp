<template>
  <div class="user-avatar-uploader">
    <div v-if="avatarUrl">
      <img v-bind:src="avatarUrl" class="avatar" />
    </div>
    <div v-else>
      <img src="/img/no-image.png" class="avatar" />
    </div>
    <input type="file" @change="onFileChanged" ref="file" class="hidden" />

    <div class="buttons" v-if="edit">
      <button type="button" class="btn btn-primary mr-3" @click="$refs.file.click()">Update</button>
      <button type="button" class="btn btn-secondary" @click="onRemove()">Remove</button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["avatar", "edit"],
  mounted: function() {
    this.avatarUrl = this.avatar;
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
      this.avatarUrl = this.url;
    },
    onUploadClicked() {
      console.log("on upload");
      //   axios.post('my-domain.com/file-upload', this.selectedFile)
    },
    onUpload() {},
    onCancel() {
      this.avatarUrl = this.avatar;
    },
    onRemove() {
      this.avatarUrl = null;
    }
  }
};
</script>

<style lang="scss" scoped>
.buttons {
  display: flex;
  justify-content: center;
  align-items: center;
  padding-top: 16px;
}

.hidden {
  display: none;
}

.avatar {
  height: 200px;
  width: 200px;
  border-radius: 50%;
  vertical-align: middle;
}

</style>