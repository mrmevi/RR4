<script>
import {defineComponent} from 'vue'
import Layout from "@/Shared/Admin/Layout.vue";
import {Head} from "@inertiajs/vue3";
import Pagination from "@/Shared/Admin/Pagination.vue";
import CreateButton from "@/Components/Admin/button/CreateButton.vue";
import route from "ziggy-js";

export default defineComponent({
    props: {
        users: Array
    },
    components: {
        CreateButton,
        Pagination,
        Layout,
        Head,
    },
    methods:{
        destroy(id) {
            if (confirm('Точно блять?')) {
                this.$inertia.delete(route('users.destroy', id))
            }
        },
    },
    data() {
        return {
            user: {
                role: 1
            }
        };
    },
    name: "Users"
})
</script>

<template>
    <Head>
        <title>Admin | Пользователи</title>
    </Head>
    <Layout>
        <div class="adminLayout__main-nameOption">
            <span>Пользователи</span>
            <CreateButton :title="'пользователя'" :link="'/admin/users/create'"/>
        </div>
        <div class="adminLayout__main-content">
            <table v-if="users.total > 0" class="adminLayout__main-content-table">
                <thead>
                <tr>
                    <th scope="col">
                        id
                    </th>
                    <th scope="col">
                        Имя пользователя
                    </th>
                    <th scope="col">
                        почта
                    </th>
                    <th scope="col">
                        Роль
                    </th>
                    <th scope="col">
                        Изменить
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(user, id) in users.data" :key="id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td v-if="user.is_admin === 1">Админ</td>
                    <td v-if="user.is_admin === 0">Пользователь</td>
                    <td>
                        <button class="refactor">
                            Редактировать
                        </button>
                        <button class="delete--button">
                            <a @click="destroy(user.id)">
                                Удалить
                            </a>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div v-else>Пользователей нет</div>
        </div>
        <Pagination :links="users.links"></Pagination>
    </Layout>
</template>

<style scoped>
.delete--button{
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
.delete--button:hover{
    color: #cbd5e0;
}
</style>
