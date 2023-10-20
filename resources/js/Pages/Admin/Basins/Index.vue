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
        basins: Array
    },
    methods: {
        destroy(id) {
            if (confirm('Точно блять?')) {
                this.$inertia.delete(route('basins.destroy', id))
            }
        },
        edite(id) {
            this.$inertia.get(route('basins.edit', id))
        },
    },
    name: "Basins"
})
</script>

<template>
    <Head>
        <title>Admin | Водоемы</title>
    </Head>
    <Layout>
        <div class="adminLayout__main-nameOption">
            <span>Все водоемы</span>
            <CreateButton :title="'водоем'" :link="'/admin/basins/create'"/>
        </div>
        <div class="adminLayout__main-content">
            <table v-if="basins.total > 0" class="adminLayout__main-content-table">
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
                <tr v-for="(basin, id) in basins.data" :key="id">
                    <td>{{ basin.id }}</td>
                    <td>{{ basin.title }}</td>
                    <td>{{ basin.slug }}</td>
                    <td>
                        <button class="edit--button">
                            <a @click="edite(basin.id)">
                                Редактировать
                            </a>
                        </button>
                        <button class="delete--button">
                            <a @click="destroy(basin.id)">
                                Удалить
                            </a>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div v-else>Водоемов не создано</div>
        </div>
        <Pagination :links="basins.links"></Pagination>
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
