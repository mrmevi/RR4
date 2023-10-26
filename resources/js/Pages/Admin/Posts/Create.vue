<template>
    <Head>
        <title>Admin | Посты | Создание</title>
    </Head>
    <Layout>
        <div class="adminCreatePosts">
            <div class="adminCreatePosts-title">
                <span>Форма создание поста</span>
            </div>
            <div class="adminCreatePosts__formFields">
                <form @submit.prevent="store">
                    <div class="adminCreatePosts__formFields-postName">
                        <span class="">Название поста:</span>
                        <input v-model="form.title" type="title" placeholder="Введите название поста...">
                    </div>
                    <div class="adminCreatePosts__formFields-shortDescription">
                        <span class="">Крaткое описание поста:</span>
                        <input v-model="form.description" type="description" placeholder="Введите краткое описание поста...">
                    </div>
                    <div class="adminCreatePosts__formFields-description">
                        <span class="">Полное описание поста:</span>
                        <textAreaUIComponent @text-updated="autoResize" />
                    </div>
                    <div class="adminCreatePosts__formFields-coordinate">
                        <span class="">Координаты:</span>
                        <input v-model="form.coordinate" type="text" placeholder="Введите координаты места ловли...">
                    </div>
                    <div class="adminCreatePosts__formFields-dataList">
                            <span class="">Водоем:</span>
                            <inputUIComponent list-id="basins" :arrayFindID="basins" @item-changed="basinsID" />
                            <span class="">Рыба:</span>
                            <inputUIComponent list-id="fish" :arrayFindID="fish" @item-changed="fishID" />
                    </div>
                    <button type="submit" class="adminCreatePosts__button-submit">
                        Отправить
                    </button>
                </form>
            </div>
        </div>
    </Layout>
</template>


<script>
import { defineComponent } from 'vue'
import Layout from "@/Shared/Admin/Layout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import textAreaUIComponent from "@/Components/Admin/textAreaUIComponent.vue"; //Импорт инпута
import inputUIComponent from "@/Components/Admin/inputUIComponent.vue"; //Импорт textArea
import route from "ziggy-js";


export default defineComponent({
    props: {
        fish: {
            type: Object,
            required: true
        },
        basins: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
          
        }
    },
    components: {
        Head,
        Layout,
        inputUIComponent,
        textAreaUIComponent
    },
    setup() {
        const form = useForm({
            title: null,
            description: null,
            content: null,
            coordinate: null,
            basin_id: null,
            fish_id: null,
            images: null
        });
        function store() {
            form.post(route('posts.store'))
        }

        return { form, store };
    },
    methods: {
        basinsID(selectedKey) {
            this.form.basin_id = selectedKey
        },
        fishID(selectedKey) {
            this.form.fish_id = selectedKey
        },
        autoResize(text) {
            this.form.content = text;
        }
    },
    name: "Create"
})
</script>


<style lang="css">
@import '../../../../styles/admin-create-post.css';
input:focus {
    border-color: blue;
    box-shadow: 0 0 5px blue;
}

textarea {
    flex-grow: 1;
    margin: 20px 0px 20px 10px;
    padding: 10px;
    font-family: Arial, sans-serif;
    font-size: 16px;
    line-height: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    resize: vertical;
}

 textarea:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}
</style>