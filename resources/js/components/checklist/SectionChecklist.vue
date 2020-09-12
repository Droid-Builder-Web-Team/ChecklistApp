<template>
    <div>
        <div class="panel panel-default">
            <h2 class="sub-title" v-bind:class="{ complete: isComplete }">
                <a id="partHeading" class="expander" data-toggle="collapse" data-parent="#accordion" v-bind:href="'#'+ section.index" v-on:click="expand()">
                    {{ section.title }}
                    <span class="flex-spacer"></span>
                    {{ completedCount }} / {{ partCount }}
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
                        <!-- <input type="checkbox" class="mr-2" /> -->
                        Complete
                    </th>
                    <th style="width: 20%">N/A</th>
                </tr>
                <tr v-for="part of section.parts" :key="part.part_id">
                    <td style="text-align: left">
                        <label class="form-check-label" for="partname" data-toggle="tooltip" data-placement="top" title="/fesfes/sefese/path">{{ part.part_name }}</label>
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

const CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

export default {
    props: ["section"],
    data: function () {
        return {
            currentSection: null,
            partCount: 0,
            completedCount: 0,
            isExpanded: false,
            isComplete: false,
        };
    },
    mounted: function () {
        this.currentSection = this.section;
        this.partCount = this.section.partCount;
        this.completedCount = this.section.numCompleted; // TODO: rename this
        this.isComplete = this.completedCount >= this.partCount;
    },
    methods: {
        onPartUpdated(part) {
            const url = "/buildprogress/" + part.id;
            const data = { completed: !!part.completed, na: !!part.NA };
            axios.patch(url, data).then((response) => {
                this.partCount = response.data.partCount;
                this.completedCount = response.data.completedCount;
                this.isComplete = this.completedCount >= this.partCount;
            });
        },
        expand() {
            this.isExpanded = !this.isExpanded;
        }
    },
};
</script>

<style lang="scss" scoped>
.complete {
    text-decoration: line-through !important;
}
</style>