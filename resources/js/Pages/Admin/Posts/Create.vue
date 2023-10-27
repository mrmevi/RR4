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
                        <input v-model="form.description" type="description"
                            placeholder="Введите краткое описание поста...">
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
                    <div class="adminCreatePosts__addImagesField">
                        <input type="file" @change="handleFileUpload" multiple>
                        <div class="adminCreatePosts__addImagesField-image-preview" v-for="(image, index) in images"
                            :key="index">
                            <img :src="image.url" :alt="image.name">
                            <div class="adminCreatePosts__addImagesField_iconsContainer">
                                <img src="../../../../assets/img/shared.png" @click="deleteImage(index)" title="Нажмите чтобы просмотреть картинку">
                                <img src="../../../../assets/img/tick.png" @click="deleteImage(index)" title="Нажмите чтобы эта картинка стала главной для поста">
                                <img src="../../../../assets/img/del.png" @click="deleteImage(index)" title="Нажмите чтобы удалить картинку"> 
                        </div>
                    </div>
                    </div>
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
            images: []
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
        },
        handleFileUpload(event) {
            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = () => {
                    this.images.push({
                        url: reader.result,
                        name: file.name
                    });
                };
                reader.readAsDataURL(file);
            }
        },
        deleteImage(index) {
            this.images.splice(index, 1);
        }
    },
    name: "Create"
})
</script>


<style lang="css">
@import '../../../../styles/admin-create-post.css';

.adminCreatePosts__addImagesField-image-preview {
    display: inline-block;
    position: relative;
    margin: 10px;
    height:auto;
    border: solid 1px;
    border-color: #ccc;
}

.adminCreatePosts__addImagesField-image-preview img {
    width: 130px;
    height: 130px;
    object-fit: cover;
}
.adminCreatePosts__addImagesField_iconsContainer{
    height: auto;
    width:100%;
    display: flex;
    justify-content: space-between;
}
.adminCreatePosts__addImagesField_iconsContainer img{
  height: 25px;
  width: 25px;
  margin:5px;
}

input:focus {
    border-color: blue;
    box-shadow: 0 0 5px blue;
}

textarea {
    flex-grow: 1;
    margin: 10px 0px 20px 10px;
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