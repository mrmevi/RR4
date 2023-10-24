<script>
import {defineComponent} from 'vue'
import MainHeaderComponent from "@/Components/Front/MainHeaderComponent.vue";
import MainSearchComponent from "@/Components/Front/MainSearchComponent.vue";

export default defineComponent({
    components: {
        MainHeaderComponent,
        MainSearchComponent,
    },
    name: "MainLayout",
})
</script>

<template>
    <MainHeaderComponent/>
    <MainSearchComponent/>
    <div class="content">
        <slot/>
    </div>
</template>

<style scoped>

</style>
