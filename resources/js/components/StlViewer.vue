<template>
  <div>
    <modal name="stl-viewer-modal" height="auto" @opened="opened">
      <div class="stl-viewer-container">
        <h1 class="dialog-title">STL Part Viewer</h1>
        <div class="model-name">{{ name }}</div>
        <div class="dialog-contents">
          <div id="container"></div>
        </div>
        <div class="dialog-footer">
          <span class="flex-spacer"></span>
          <button class="btn btn-primary" @click="hide()">Close</button>
        </div>
      </div>
    </modal>
    <button @click="show()" class="btn btn-primary">Show Part</button>
  </div>
</template>

<script>
import * as THREE from "three";
import { STLLoader } from "three/examples/jsm/loaders/STLLoader.js";
import { OrbitControls } from "three/examples/jsm/controls/OrbitControls.js";

export default {
  name: "stl-viewer",
  data() {
    return {
      camera: null,
      scene: null,
      renderer: null,
      mesh: null,
      controls: null,
      name: ""
    };
  },
  mounted() {},
  methods: {
    init: function () {
      let container = document.getElementById("container");
      this.renderer = new THREE.WebGLRenderer({ antialias: true });
      this.renderer.setSize(container.clientWidth, container.clientHeight);
      this.renderer.setClearColor(0xFFFFFF, 0.7);
      container.appendChild(this.renderer.domElement);

      this.camera = new THREE.PerspectiveCamera(
        70,
        container.clientWidth / container.clientHeight,
        0.01,
        1000
      );
      this.camera.position.z = 10;

      this.controls = new OrbitControls(this.camera, this.renderer.domElement);

      this.scene = new THREE.Scene();

      this.scene.add(new THREE.HemisphereLight(0x443333, 0xffffff));

      var light = new THREE.PointLight(0xffffff);
      this.scene.add(light);

      var loader = new STLLoader();
      this.name = "Baby_Yoda_v2.2.stl";
      loader.load("/stl/Baby_Yoda_v2.2.stl", (geometry) => {
        var material = new THREE.MeshPhongMaterial({
          color: 0x00ff00,
          specular: 0x111111,
          shininess: 200,
        });
        this.mesh = new THREE.Mesh(geometry, material);

        this.mesh.position.set(0, -0.25, 0.6);
        this.mesh.rotation.set(0, -Math.PI / 2, 0);
        this.mesh.scale.set(0.05, 0.05, 0.05);
        this.camera.lookAt(this.mesh.position);

        this.mesh.castShadow = true;
        this.mesh.receiveShadow = true;

        this.scene.add(this.mesh);
      });
    },
    animate: function () {
      requestAnimationFrame(this.animate);
      this.controls.update();
      this.renderer.render(this.scene, this.camera);
    },
    opened() {
      this.init();
      this.animate();
    },
    show() {
      this.$modal.show("stl-viewer-modal");
    },
    hide() {
      this.$modal.hide("stl-viewer-modal");
    },
  },
};
</script>

<style lang="scss" scoped>
.stl-viewer-container {
  padding: 16px 16px 16px 16px;

  .dialog-contents {
    display: flex;
    width: 100%;
    justify-content: center;
    height: 400px;

    .model-name {
        padding: 4px 0;
    }

    #container {
        width: 100%;
        height: 100%;
    }
  }

  .dialog-footer {
    display: flex;
    padding-top: 8px;
  }
}
</style>