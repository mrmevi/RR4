<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "Home"
})
</script>

<template>
Home
<div v-if="$page.props.user">
    {{ $page.props.user.name }}
</div>
</template>

<style scoped>

</style>
