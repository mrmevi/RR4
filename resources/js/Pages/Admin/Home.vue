<script>
import {defineComponent} from 'vue'
import Layout from "@/Shared/Admin/Layout.vue";
import {Head} from "@inertiajs/vue3";
import Pagination from "@/Shared/Admin/Pagination.vue";
import route from "ziggy-js";

export default defineComponent({
    props: {
        posts: Array
    },
    components: {
        Layout,
        Head,
        Pagination,
    },
    methods: {
        decide(id) {
            if (confirm('Точно блять?')) {
                this.$inertia.get(route('posts.decide', id))
            }
        },
        edit(id) {
            this.$inertia.get(route('posts.edit', id))
        },
        destroy(id) {
            if (confirm('Точно блять?')) {
                this.$inertia.delete(route('posts.destroy', id))
            }
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString();
        },
        formatTime(date) {
            return new Date(date).toLocaleTimeString();
        }
    },
    name: "Home"
})
</script>

<template>
    <Head>
        <title>Admin | Модерация</title>
    </Head>
    <Layout>
        <div class="adminLayout__main-nameOption">
            <span>Модерация постов</span>
        </div>
        <div class="adminLayout__main-content">
            <table v-if="posts.total > 0" class="adminLayout__main-content-table">
                <thead>
                <tr>
                    <th scope="col">
                        id вавававава
                    </th>
                    <th scope="col">
                        title
                    </th>
                    <th scope="col">
                        desc
                    </th>
                    <th scope="col">
                        coor
                    </th>
                    <th scope="col">
                        basin
                    </th>
                    <th scope="col">
                        fish
                    </th>
                    <th scope="col">
                        created_at
                    </th>
                    <th class="manageInfo" scope="col">
                        refactor
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(post, id) in posts.data" :key="id">
                    <td>{{ post.id }}</td>
                    <td>{{ post.title }}</td>
                    <td>{{ post.description }}</td>
                    <td>{{ post.coordinate }}</td>
                    <td>{{ post.basin_id }}</td>
                    <td>{{ post.fish_id }}</td>
                    <td>{{ formatDate(post.created_at) }} {{ formatTime(post.created_at) }}</td>
                    <td>
                        <button class="refactor">
                            <a @click="decide(post.id)">
                                <img class="refactor__img" src="../../../assets/img/commit.svg" alt="">
                            </a>
                        </button>
                        <button class="refactor">
                            <a @click="edit(post.id)">
                                <img class="refactor__img" src="../../../assets/img/edite.svg" alt="">
                            </a>
                        </button>
                        <button class="refactor">
                            <a @click="destroy(post.id)">
                                <img class="refactor__img" src="../../../assets/img/delete.svg" alt="">
                            </a>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div v-else>Постов на модерации нет</div>
        </div>
        <Pagination :links="posts.links"></Pagination>
    </Layout>
</template>

<style scoped>
.refactor__img {
    max-width: 24px;
    max-height: 24px
}
</style>
