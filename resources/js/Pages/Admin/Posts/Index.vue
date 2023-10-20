<script>
import {defineComponent} from 'vue'
import Layout from "@/Shared/Admin/Layout.vue";
import {Head} from "@inertiajs/vue3";
import Pagination from "@/Shared/Admin/Pagination.vue";
import CreateButton from "@/Components/Admin/button/CreateButton.vue";
import route from "ziggy-js";


export default defineComponent({
    props: {
        posts: Object
    },
    components: {
        CreateButton,
        Pagination,
        Layout,
        Head,
    },
    methods:{
        route,
        toModerate(id){
            if (confirm('Точно блять?')) {
                this.$inertia.get(route('posts.dontDecide', id))
            }
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString();
        },
        formatTime(date) {
            return new Date(date).toLocaleTimeString();
        }
    },
    name: "Home",
})
</script>

<template>
    <Head>
        <title>Admin | Посты</title>
    </Head>
    <Layout>
        <div class="adminLayout__main-nameOption">
            <span>Все посты</span>
            <CreateButton :title="'пост'" :link="route('posts.create')"/>
        </div>
        <div class="adminLayout__main-content">
            <table v-if="posts.total > 0" class="adminLayout__main-content-table">
                <thead>
                <tr>
                    <th scope="col">
                        id
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
                    <th scope="col">
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
                    <td>{{ formatDate(post.created_at) }} {{formatTime(post.created_at)}}</td>
                    <td>
                        <button class="moderate--button">
                            <a @click="toModerate(post.id)">
                                Модерировать
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
.moderate--button{
    background-color: coral;
    border-radius: 8px;
    border: none;
    color: white;
    padding: 6px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    opacity: 80%;
}
.moderate--button:hover{
    color: #cbd5e0;
}
</style>
