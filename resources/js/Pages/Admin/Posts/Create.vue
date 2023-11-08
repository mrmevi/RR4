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
                        <span>Название поста:</span>
                        <input v-model="form.title" type="title" placeholder="Введите название поста...">
                    </div>
                    <div class="adminCreatePosts__formFields-shortDescription">
                        <span>Крaткое описание поста:</span>
                        <input v-model="form.description" type="description"
                            placeholder="Введите краткое описание поста...">
                    </div>
                    <div class="adminCreatePosts__formFields-description">
                        <span>Полное описание поста:</span>
                        <textAreaUIComponent @text-updated="autoResize" />
                    </div>
                    <div class="adminCreatePosts__formFields-coordinate">
                        <span>Координаты:</span>
                        <input v-model="form.coordinate" type="text" placeholder="Введите координаты места ловли...">
                    </div>
                    <div class="adminCreatePosts__formFields-dataList">
                        <span>Водоем:</span>
                        <customDataList 
                         list-id="basins" 
                         :arrayFindID="basins" 
                         @item-changed="basinsID" 
                         :stylePath="stylePathToDatalist"
                         />
                        <span>Рыба:</span>
                        <customDataList 
                        list-id="fish" 
                        :arrayFindID="fish" 
                        @item-changed="fishID" 
                        :stylePath="stylePathToDatalist"
                        />
                    </div>
                    <div class="adminCreatePosts__addImagesField">
                        <imageInputComponent :stylePathToAddImageField="stylePathToAddImageField"/>
                      
                    </div>
                    <div class="adminCreatePosts_modal" v-if="isOpen">
                        <span class="adminCreatePosts_close" @click="isOpen = false" @keyup.enter="handleEnterKey">×</span>
                        <img :src="modalImage" class="adminCreatePosts_modal-content" id="img">
                    </div>
                    <button class="adminCreatePosts__button-submit">Отправить</button>
                </form>
            </div>
        </div>
    </Layout>
</template>


<script>
import { defineComponent } from 'vue'
import Layout from "@/Shared/Admin/Layout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import textAreaUIComponent from "@/Components/Admin/textAreaUIComponent.vue"; //Импорт textArea
import customDataList from "@/Components/Admin/customDataList.vue"; //Импорт customDataList
import imageInputComponent from "@/Components/Admin/imageInputComponent.vue"; //Импорт DropZone
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
            images: [],
            stylePathToDatalist:'../../../../../resources/styles/adminCustomDataListStyles.css',
            stylePathToAddImageField:'../../../../../resources/styles/adminAddImagesField.css'
        }
    }, 
    components: {
        Head,
        Layout,
        textAreaUIComponent,
        customDataList,
        imageInputComponent
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
            this.form.images = this.images
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
    },
    name: "Create"
})
</script>


<style lang="css">
@import '../../../../styles/admin-create-post.css';
</style>