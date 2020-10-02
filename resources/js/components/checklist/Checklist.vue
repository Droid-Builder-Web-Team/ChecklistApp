<template>
    <div class="checklist" v-if="currentBuild">
        <h2 class="sub sub-title text-center">Checklist</h2>
        <p class="sub sub-text">Ticked the parts you have printed, tick the N/A box to exlude that part.</p>

        <div v-for="section in parts" v-bind:key="section.droid_section">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a id="partHeading" data-toggle="collapse" v-bind:href="'#'+ section.droid_section" v-on:click="section.isExpanded = !section.isExpanded">
                            <span class="mr-2">{{ section.title }} </span>
                            <i class="toggle-icon fa fa-angle-down" v-if="!section.isExpanded"></i>
                            <i class="toggle-icon fa fa-angle-up" v-else></i>
                        </a>
                    </h4>
                </div>
            </div>
            <div v-bind:id="section.droid_section" class="panel-collapse collapse">
                <div class="panel-group">
                    <div v-for="subsection in section.subsections" :key="subsection.index">
                        <section-checklist :section="subsection" :id="id"></section-checklist>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</template>

<script>
export default {
    props: ["droid", "sections", "id"],
    data: function () {
        return {
            currentBuild: null,
            parts: [],
            isExpanded: false,
        };
    },
    mounted: function () {
        this.parts = JSON.parse(this.sections);
        this.currentBuild = JSON.parse(this.droid);
    }
};
</script>

<style lang="scss" scoped>

</style>

