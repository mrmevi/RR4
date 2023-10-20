<script>
import {defineComponent} from 'vue'
import {Link} from "@inertiajs/vue3";

export default defineComponent({
    components: {
        Link,
    },
    props: {
        link: String,
        title: String,
    },
    name: "CreateButton"
})
</script>

<template>
    <button class="create__button">
        <Link class="create__link" :href="link">
            Добавить {{ title }}
        </Link>
    </button>

</template>

<style scoped>
.create__button {
    background-color: mediumseagreen;
    border-radius: 8px;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    opacity: 80%;
}
.create__link{
    color: white;
    text-decoration: none;
}
.create__link:hover{
    color: bisque;
}
</style>
