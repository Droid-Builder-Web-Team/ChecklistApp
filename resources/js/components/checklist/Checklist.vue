<template>
    <div class="checklist" v-if="currentBuild">
        <h2 class="sub sub-title text-center">Checklist</h2>
        <p class="sub sub-text">Ticked the parts you have printed, tick the N/A box to exlude that part.</p>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a id="partHeading" data-toggle="collapse" href="#checklistCollapse" v-on:click="isExpanded = !isExpanded">
                        <span class="mr-2">{{ currentBuild.class }}</span>
                        <i class="toggle-icon fa fa-angle-down" v-if="!isExpanded"></i>
                        <i class="toggle-icon fa fa-angle-up" v-else></i>
                    </a>
                </h4>
            </div>
        </div>
        <div id="checklistCollapse" class="panel-collapse collapse show">
            <div class="panel-group">
                <div v-for="section in parts" :key="section.id">
                    <section-checklist :section="section"></section-checklist>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["droid", "sections"],
    data: function () {
        return {
            currentBuild: null,
            parts: [],
            isExpanded: true,
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

