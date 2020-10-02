<template>
    <div>
        <div class="panel panel-default">
            <h2 class="sub-title" v-bind:class="{ complete: allComplete }">
                <a id="partHeading" class="expander" data-toggle="collapse" v-bind:href="'#'+ section.index" v-on:click="expand()">
                    {{ section.title }}
                    <span class="flex-spacer"></span>
                    {{ partsPrinted }} / {{ partsTotal }}
                    <button class="btn expand-icon">
                        <i class="toggle-icon fa fa-angle-down" v-if="!isExpanded"></i>
                        <i class="toggle-icon fa fa-angle-up" v-else></i>
                    </button>
                </a>
            </h2>
        </div>
        <div :id="section.index" class="panel-collapse collapse">
            <table class="partsTable" border="1">
                <tr>
                    <th style="text-align: left">Part Name</th>
                    <th style="width: 25%">
                        <input type="checkbox" class="mr-2" v-model="allComplete" v-on:change="onCompleteAll()" />
                        Complete
                    </th>
                    <th style="width: 20%">
                        <input type="checkbox" class="mr-2" v-model="allNA" v-on:change="onNAAll()" />
                        N/A
                    </th>
                </tr>
                <tr v-for="part of section.parts" :key="part.part_id">
                    <td style="text-align: left">
                        <label class="form-check-label" for="partname" data-toggle="tooltip" data-placement="bottom" :title="part.file_path">{{ part.part_name }}</label>
                    </td>
                    <td>
                        <input type="checkbox" name="partid[]" v-model="part.completed" v-on:change="onPartUpdated(part)" />
                    </td>
                    <td>
                        <input type="checkbox" name="na[]" v-model="part.NA" v-on:change="onPartUpdated(part)" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: ["section", "id"],
    data: function () {
        return {
            currentSection: null,
            partsTotal: 0,
            partsPrinted: 0,
            isExpanded: false,
            allComplete: false,
            allNA: false,
        };
    },
    mounted: function () {
        this.currentSection = this.section;
        this.partsTotal = this.section.partCount;
        this.partsPrinted = this.section.numCompleted; // TODO: rename this
        this.allComplete = this.isAllComplete();
        this.allNA = this.isAllNA();
    },
    methods: {
        isAllComplete() {
            let completed = true;
            for (let part of this.section.parts) {
                completed &= part.completed;
            }
            return completed;
        },
        isAllNA() {
            let na = true;
            for (let part of this.section.parts) {
                na &= part.NA;
            }
            return na;
        },
        onPartUpdated(part) {
            const url = "/droids/buildprogress/" + part.id;
            const data = { completed: !!part.completed, na: !!part.NA };
            axios.patch(url, data).then(response => {
                this.partsTotal = response.data.partsTotal - response.data.partsNA;
                this.partsPrinted = response.data.partsPrinted;
                this.allComplete = this.isAllComplete();
                this.allNA = this.isAllNA();
                this.$root.$emit("checklistUpdated");
            });
        },
        onCompleteAll() {
            const url = "/droids/buildprogress/" + this.id + "/completeall/" + this.section.title;
            for (let part of this.section.parts) {
                part.completed = this.allComplete;
            }
            const ids = this.section.parts.map((part) => {
                return part.id;
            });
            const data = { completed: this.allComplete, ids: ids };
            axios.post(url, data).then(response => {
                this.partsTotal = response.data.partsTotal - response.data.partsNA;
                this.partsPrinted = response.data.partsPrinted;
                this.allComplete = this.isAllComplete();
                this.allNA = this.isAllNA();
                this.$root.$emit("checklistUpdated");
            });
        },
        onNAAll() {
            const url =
                "/droids/buildprogress/" + this.id + "/naall/" + this.section.title;
            for (let part of this.section.parts) {
                part.NA = this.allNA;
            }
            const ids = this.section.parts.map((part) => {
                return part.id;
            });
            const data = { na: this.allNA, ids: ids };
            axios.post(url, data).then((response) => {
                this.partsTotal = response.data.partsTotal - response.data.partsNA;
                this.partsPrinted = response.data.partsPrinted;
                this.allComplete = this.isAllComplete();
                this.allNA = this.isAllNA();
                this.$root.$emit("checklistUpdated");
            });
        },
        expand() {
            this.isExpanded = !this.isExpanded;
        },
    },
};
</script>

<style lang="scss" scoped>
.complete {
    text-decoration: line-through !important;
}
</style>
