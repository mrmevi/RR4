<script>
import {defineComponent} from 'vue'
import {Link} from "@inertiajs/vue3";

export default defineComponent({
    components: {
        Link,
    },
    props: {
        links: Array
    },
    name: "Pagination"
})
</script>

<template>
    <div v-if="links.length > 3" id="paginationComponents">
        <div class="paginationComponents__leftSide">
            <span>Showing 1 to 10 of 97 results</span>
        </div>
        <div class="paginationComponents__rightSide">
            <Link
                v-for="(link, k) in links"
                :href="link.url"
                :key="k"
                :disabled="link.url === null"
                :class="{
                    'paginationComponents__rightSide-active': link.active,
                }"
                v-html="link.label">
            </Link>
        </div>
    </div>
</template>

<style>
*{
    padding: 0;
    margin: 0;
    font-family: helvetica;
}
#paginationComponents {
    height: 10%;
    width: 100%;
    flex-shrink: 0;
    align-self: flex-end;
    display: flex;
    border-top: solid 1px;
    border-color: rgba(0, 0, 0, 0.353);
}
.paginationComponents__leftSide {
    height: auto;
    width: 30%;
    display: flex;
    align-items: center;
    margin-left: 30px;
    margin-right: auto;
}

.paginationComponents__leftSide span {
    color: var(--Black, #2F2F2F);
    font-size: 20px;
    font-style: normal;
    font-weight: 500;
    line-height: 120%;
}

.paginationComponents__rightSide {
    height: fit-content;
    width: auto;
    display: flex;
    margin-left: auto;
    margin-right: 30px;
    margin-top: 10px;
    margin-bottom: 10px;
    border: solid 1px;
    border-color: rgba(0, 0, 0, 0.353);
    border-radius: 10px;
    overflow: hidden;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.paginationComponents__rightSide button {
    height: auto;
    padding: 15px;
    width: auto;
    border: none;
    border-color: rgba(0, 0, 0, 0.353);
    background-color: inherit;
}

.paginationComponents__rightSide-active {
    color: whitesmoke;
    background-color: dodgerblue;
}

.paginationComponents__rightSide a {
    height: auto;
    padding: 15px;
    width: auto;
    text-decoration: none;
    color: var(--Black, #2F2F2F);
    font-size: 15px;
    font-style: normal;
    font-weight: 500;
    line-height: 120%;
    border-color: rgba(0, 0, 0, 0.353);
}
</style>
