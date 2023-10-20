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
        Layout,
        Head,
    },
    props: {
        fish: Array
    },
    methods: {
        destroy(id) {
            if (confirm('Точно блять?')) {
                this.$inertia.delete(route('fish.destroy', id))
            }
        },
        edit(id) {
            this.$inertia.get(route('fish.edit', id))
        },
    },
    name: "Fish"
})
</script>

<template>
    <Head>
        <title>Admin | Наименования рыб</title>
    </Head>
    <Layout>
        <div class="adminLayout__main-nameOption">
            <span>Все наименования рыб</span>
            <CreateButton :title="'наименование рыбы'" :link="'/admin/fish/create'"/>
        </div>
        <div class="adminLayout__main-content">
            <table v-if="fish.total > 0" class="adminLayout__main-content-table">
                <thead>
                <tr>
                    <th class="id" scope="col">
                        id
                    </th>
                    <th scope="col">
                        title
                    </th>
                    <th scope="col">
                        slug
                    </th>
                    <th scope="col">
                        simple
                    </th>
                    <th scope="col">
                        zachet
                    </th>
                    <th scope="col">
                        chat
                    </th>
                    <th scope="col">
                        trophy
                    </th>
                    <th scope="col">
                        rareTrophy
                    </th>
                    <th scope="col">
                        refactor
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item, id) in fish.data" :key="id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.title }}</td>
                    <td>{{ item.slug }}</td>
                    <td>{{ item.simple }}</td>
                    <td>{{ item.zachet }}</td>
                    <td>{{ item.chat }}</td>
                    <td>{{ item.trophy }}</td>
                    <td>{{ item.rareTrophy }}</td>
                    <td>
                        <button class="edit--button">
                            <a @click="edit(item.id)">
                                Редактировать
                            </a>
                        </button>
                        <button class="delete--button">
                            <a @click="destroy(item.id)">
                                Удалить
                            </a>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div v-else>Наименований рыб не создано</div>
        </div>
        <Pagination :links="fish.links"></Pagination>
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
