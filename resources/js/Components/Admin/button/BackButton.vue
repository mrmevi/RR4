<script>
import {defineComponent} from 'vue'
import {Link} from "@inertiajs/vue3";
import route from "ziggy-js";

export default defineComponent({
    components: {
        Link,
    },
    methods:{
        route,
        goBack() {
        },
    },
    name: "BackButton"
})
</script>

<template>
    <button class="back__button">
        <Link class="back__link" onclick="history.back()">
            Вернуться назад
        </Link>
    </button>

</template>

<style scoped>
.back__button {
    margin-bottom: 12px;
    margin-top: 12px;
    border-radius: 8px;
    border: 2px solid chocolate;
    background-color: coral;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    opacity: 80%;
}
.back__link{
    color: white;
    text-decoration: none;
}
.back__link:hover{
    color: grey;
}
</style>
