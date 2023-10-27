<script>
import {defineComponent} from 'vue'
import Layout from "@/Shared/Admin/Layout.vue";
import {Head} from "@inertiajs/vue3";
import Pagination from "@/Shared/Admin/Pagination.vue";
import CreateButton from "@/Components/Admin/button/CreateButton.vue";
import route from "ziggy-js";

export default defineComponent({
    components: {
        CreateButton,
        Pagination,
        Head,
        Layout
    },
    props: {
        tags: Array
    },
    methods: {
        destroy(id) {
            if (confirm('Точно блять?')) {
                this.$inertia.delete(route('tags.destroy', id))
            }
        },
        edite(id) {
            this.$inertia.get(route('tags.edit', id))
        },
    },
    name: "Tags"
})
</script>

<template>
    <Head>
        <title>Admin | Теги</title>
    </Head>
    <Layout>
        <div class="adminLayout__main-nameOption">
            <span>Все теги</span>
            <CreateButton :title="'тег'" :link="'/admin/tags/create'"/>
        </div>
        <div class="adminLayout__main-content">
            <table v-if="tags.total > 0" class="adminLayout__main-content-table">
                <thead>
                <tr>
                    <th scope="col">
                        id
                    </th>
                    <th scope="col">
                        title
                    </th>
                    <th scope="col">
                        slug
                    </th>
                    <th scope="col">
                        refactor
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(tag, id) in tags.data" :key="id">
                    <td>{{ tag.id }}</td>
                    <td>{{ tag.title }}</td>
                    <td>{{ tag.slug }}</td>
                    <td>
                        <button class="edit--button">
                            <a @click="edite(tag.id)">
                                Редактировать
                            </a>
                        </button>
                        <button class="delete--button">
                            <a @click="destroy(tag.id)">
                                Удалить пока не работает
                            </a>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div v-else>Тегов не создано</div>
        </div>
        <Pagination :links="tags.links"></Pagination>
    </Layout>
</template>

<style scoped>
.delete--button {
    background-color: red;
    border-radius: 8px;
    border: none;
    color: white;
    padding: 6px 12px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    opacity: 65%;
}

.delete--button:hover {
    color: #cbd5e0;
}
.edit--button{
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
.edit--button:hover {
    color: #cbd5e0;
}
</style>
