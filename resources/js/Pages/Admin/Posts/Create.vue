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
                        <input type="file" title="Выберите файлы" placeholder="Выберите файлы" @change="handleFileUpload" multiple>
                        <div class="adminCreatePosts__addImagesField-image-preview" v-for="(image, index) in images"
                            :key="index" @mouseover="upPanel = index" @mouseleave="upPanel = null">
                            <img :src="image.url" :alt="image.name"
                                :class="{ 'adminCreatePosts__addImagesField-image-preview-panel-green-border': index === selectedImageIndex }">
                            <div class="adminCreatePosts__addImagesField-deleteIcon" @click="deleteImage(index)">
                                ✕</div>
                            <div class='adminCreatePosts__addImagesField-image-preview-panel' v-if="upPanel === index">
                                <img src="../../../../assets/img/shared.png" :alt="image.name"
                                    @click="toggleFullscreen(image)">
                                <img src="../../../../assets/img/tick.png" :alt="image.name" @click="selectImage(index)">
                            </div>
                        </div>
                    </div>
                    <div class="adminCreatePosts_modal" v-if="isOpen">
                        <span class="adminCreatePosts_close" @click="isOpen = false" @keyup.enter.stop="handleEnterKey">×</span>
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
            images: [],
            upPanel: false,
            isOpen: false,
            selectedImageIndex: null,
            isImageClicked: false,
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
                        name: file.name,
                    });
                };
                reader.readAsDataURL(file);
            }
        },
        deleteImage(index) {
            this.images.splice(index, 1);
        },
        selectImage(index) {
            this.selectedImageIndex = index;
        },
        toggleFullscreen(image) {
            this.isOpen = true;
            this.modalImage = image.url
        },
        handleEnterKey() {
      this.isOpen = false;
    },
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
    height: 130px;
}

.adminCreatePosts__addImagesField-image-preview img {
    width: 130px;
    height: 130px;
    object-fit: cover;
}

.adminCreatePosts__addImagesField-deleteIcon {
    color: rgb(0, 0, 0);
    position: absolute;
    right: 0px;
    top: 0px;
    padding: 5px;
    background-color: rgb(255, 255, 255);
}

.adminCreatePosts__addImagesField-deleteIcon:hover {
    opacity: 1;
    cursor: pointer;
}

.adminCreatePosts__addImagesField-image-preview-panel {
    width: 100%;
    display: flex;
    position: absolute;
    cursor: pointer;
    bottom: 0px;
    padding: 5px;
    background-color: rgba(255, 255, 255, 0.304);
    justify-content: space-around;
}

.adminCreatePosts__addImagesField-image-preview-panel img {
    height: 25px;
    width: 25px;
}

.adminCreatePosts_modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
}

.adminCreatePosts_modal img {
    max-width: 100%;
    max-height: 100%;
}

.adminCreatePosts_close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.adminCreatePosts_close:hover,
.adminCreatePosts_close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

.adminCreatePosts__addImagesField-image-preview-panel-green-border {
    border: 2px solid green;
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