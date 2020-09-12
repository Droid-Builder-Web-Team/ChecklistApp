<template>
    <div>
        <div class="tracking">
            <p class="text-center" id="build-progress">
                Progress:
                <span id="percentComplete">{{ percentComplete }}</span>%
            </p>
        </div>
        <p class="lead text-center" style="color:white;">
            Built
            <span id="completedCount">{{ completedCount }}</span> of
            <span id="partCount">{{ partCount }}</span> parts
        </p>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: ["completed", "parts", "id"],
    data: function () {
        return {
            completedCount: 0,
            partCount: 0,
            percentComplete: 0,
        };
    },
    mounted: function () {
        this.completedCount = this.completed;
        this.partCount = this.parts;
        this.percentComplete = parseFloat(
            (this.completedCount / this.partCount) * 100
        ).toFixed(2);
    },
    created: function () {
        this.$root.$on("checklistUpdated", () => {
            const url = "/buildprogress/" + this.id;
            axios.get(url).then((response) => {
                this.completedCount = response.data.completedCount;
                this.partCount = response.data.partCount;
                this.percentComplete = parseFloat(
                    (this.completedCount / this.partCount) * 100
                ).toFixed(2);
            });
        });
    },
};
</script>

<style lang="scss" scoped>
</style>