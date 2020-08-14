<template>
<div>
    <StlViewer></StlViewer>
    <modal name="my-first-modal">
        This is my first modal
    </modal>
    <button @click="show()">Modal</button>
    </div>
</template>

<script>

import StlViewer from "./StlViewer";

export default {
    name: 'MyComponent',
    components: {
        StlViewer
    },
    methods: {
        show () {
            this.$modal.show("StlViewer");
        },
        hide () {
            this.$modal.hide('my-first-modal');
        }
    },
    mount () {
        this.show()
    }
}
</script>