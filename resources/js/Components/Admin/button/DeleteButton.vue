<script>
import {defineComponent} from 'vue'
import {Link} from "@inertiajs/vue3";

export default defineComponent({
    components: {
        Link,
    },
    props: {
        link: String,
    },
    name: "CreateButton"
})
</script>

<template>
    <button class="delete__button">
        <Link class="delete__link" :href="link">
            Удалить
        </Link>
    </button>

</template>

<style scoped>
.delete__button {
    background-color: #4CAF50;
    border-radius: 8px;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
.delete__link{
    color: white;
    font-family: helvetica;
    text-decoration: none;
}
</style>
