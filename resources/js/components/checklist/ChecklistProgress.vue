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
            <span id="partsPrinted">{{ partsPrinted }}</span> of
            <span id="partsTotal">{{ partsTotal }}</span> parts
        </p>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: ["completed", "parts", "id"],
    data: function () {
        return {
            partsPrinted: 0,
            partsTotal: 0,
            percentComplete: 0,
        };
    },
    mounted: function () {
        this.partsPrinted = this.completed;
        this.partsTotal = this.parts;
        if (this.partsTotal === 0) {
            this.percentComplete = 0;
        } else {
            this.percentComplete = parseFloat(
                (this.partsPrinted / this.partsTotal) * 100
            ).toFixed(2);
        }
    },
    created: function () {
        this.$root.$on("checklistUpdated", () => {
            const url = "/droids/buildprogress/" + this.id;
            axios.get(url).then((response) => {
                this.partsPrinted = response.data.partsPrinted;
                this.partsTotal = response.data.partsTotal - response.data.partsNA;
                if (this.partsTotal === 0) {
                    this.percentComplete = 0;
                } else {
                    this.percentComplete = parseFloat(
                        (this.partsPrinted / this.partsTotal) * 100
                    ).toFixed(2);
                }
            });
        });
    },
};
</script>

<style lang="scss" scoped>
</style>