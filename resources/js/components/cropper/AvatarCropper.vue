<template>
  <Cropper
    class="circle-example"
    ref="cropper"
    :src="avatarUrl"
    :stencil-component="stencil"
    @change="onChange"
    :stencil-props="props"
  />
</template>

<script>
import { Cropper } from "vue-advanced-cropper";
import CircleStencil from "./CircleStencil";
export default {
  name: "AvatarCropper",
  props: ["avatar"],
  components: {
    Cropper,
  },
  watch: {
    avatar: function (newVal, oldVal) {
      this.avatarUrl = newVal;
    },
  },
  methods: {
    onChange({ _coordinates, _canvas }) {
      const { coordinates, canvas } = this.$refs.cropper.getResult();
      console.log(coordinates);
      console.log(canvas);
      this.$emit("change", canvas);
    },
  },
  mounted: function () {
    this.avatarUrl = this.avatar;
    console.log(this.avatarUrl);
  },
  data() {
    return {
      stencil: CircleStencil,
      props: {
        aspectRatio: 1,
      },
      selectedFile: null,
      avatarUrl: null,
    };
  },
};
</script>

<style lang="scss">
.circle-example {
  max-width: 250px;
  max-height: 250px;
}
</style>