<script>
import {defineComponent} from 'vue'
import Layout from "@/Shared/Admin/Layout.vue";
import {Head, useForm} from "@inertiajs/vue3";
import BackButton from "@/Components/Admin/button/BackButton.vue";
import route from "ziggy-js";
import {Dropzone} from "dropzone";
import 'dropzone/dist/dropzone.css'
import 'dropzone/dist/basic.css'


export default defineComponent({
    components: {
        BackButton,
        Head,
        Layout,
    },
    setup(props) {
        const form = useForm({
            title: props.post.title,
            description: props.post.description,
            content: props.post.content,
            coordinate: props.post.coordinate,
            basin_id: props.post.basin_id,
            fish_id: props.post.fish_id,
            images: null,
        });

        function update() {
            /*form.images = this.dropzone.getAcceptedFiles();*/
            form.put(route('posts.update', props.post.id))
        }

        return {form, update};
    },
    props: {
        post: Object,
        images: Object,
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
            dropzone: null
        }
    },
    mounted(props) {
        this.dropzone = new Dropzone(this.$refs.dropzone, {
            url: "22",
            acceptedFiles: '.jpg,.png,.jpeg',
            dictDefaultMessage: 'Перетащите файлы сюда или нажмите для загрузки',
            dictFallbackMessage: 'Ваш браузер не поддерживает перетаскивание файлов',
            dictInvalidFileType: 'Неверный тип файла. Разрешены только файлы с расширениями: {{acceptedFiles}}',
            dictResponseError: 'Сервер вернул ошибку {{statusCode}}',
            dictCancelUpload: 'Отменить загрузку',
            dictCancelUploadConfirmation: 'Вы уверены, что хотите отменить загрузку?',
            dictRemoveFile: 'Отменить',
            addRemoveLinks: true,
            clickable: true,
            autoProcessQueue: false,
        })
    },
    name: "Create"
})
</script>

<template>
    <Head>
        <title>Admin | Посты | Редактирование</title>
    </Head>
    <Layout>
        <div class="adminLayout__main-nameOption">
            <span>Форма редактирования поста</span>
            <BackButton></BackButton>
        </div>
        <div class="form__post">
            <form @submit.prevent="update">
                <div class="form__post-title">
                    <span class="">Название поста:</span>
                    <input v-model="form.title" type="text">
                </div>
                <div class="form__post-desc">
                    <span class="">Короткое описание поста:</span>
                    <input v-model="form.description" type="text">
                </div>
                <div class="form__post-content">
                    <span class="">Полное описание поста:</span>
                    <textarea v-model="form.content"></textarea>
                </div>
                <div class="form__post-information">
                    <div class="coordinate">
                        <span class="">Координаты:</span>
                        <input v-model="form.coordinate" type="number">
                    </div>
                    <div class="basin">
                        <span class="">Водоем:</span>
                        <input list="basins" v-model="form.basin_id" type="text">
                        <datalist id="basins">
                            залупа
                        </datalist>
                    </div>
                    <div class="fish">
                        <span class="">Рыба:</span>
                        <input list="fish" v-model="form.fish_id">
                        <datalist id="fish">
                            залупа
                        </datalist>
                    </div>
                </div>
                <div class="form__post-images_span">
                    <span class="">Изображения:</span>
                </div>
                <div class="form__post-images">
                    <div ref="dropzone" class="dropzone">
                    </div>
                </div>
                <div class="form__post-images">
                </div>
                <div class="form__post-submit">
                    <button type="submit">
                        Редактировать
                    </button>
                </div>
            </form>
        </div>
    </Layout>
</template>

<style scoped>
.form__post {
    padding-top: 20px;
    padding-left: 35px;
}

span {
    color: #202020;
    font-size: 18px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    letter-spacing: -1.2px;
}

input {
    height: 35px;
    align-self: stretch;
    border-radius: 16px;
    border: none;
    background: #F5F5F5;
    padding-left: 30px;
}

input:focus {
    border: 1px solid grey;
    outline: none;
    padding-left: 30px;
}

textarea {
    height: 124px;
    align-self: stretch;
    border-radius: 20px;
    background: #F5F5F5;
    padding-left: 30px;
    border: none;
}

textarea:focus {
    border: 1px solid grey;
    outline: none;
    padding-top: 5px;
    padding-left: 30px;
}

.form__post-title {
    display: flex;
    width: 1196px;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
}

.form__post-desc {
    padding-top: 20px;
    display: flex;
    width: 1196px;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
}

.form__post-content {
    padding-top: 20px;
    display: flex;
    width: 1196px;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
}

.form__post-information {
    padding-top: 20px;
    display: inline-flex;
    align-items: flex-start;
    gap: 25px;
}

.coordinate {
    display: flex;
    width: 382px;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
}

.basin {
    display: flex;
    width: 382px;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px
}

.fish {
    display: flex;
    width: 382px;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px
}

.form__post-submit {
    padding-top: 30px;
    padding-bottom: 30px;
}

.form__post-submit button {
    width: 140px;
    height: 40px;
    border-radius: 16px;
    border: 2px solid #249112;
    background: rgba(94, 232, 99, 0.81);
}

.form__post-submit button:hover {
    color: white;
}
.form__post-images_span{
    padding-top: 20px;
}
.form__post-images {
    padding-top: 20px;
    display: flex;
    justify-content: left;
    align-items: center;
}

.dropzone {
    border-radius: 20px;
    background: #F5F5F5;
    opacity: 80%;
    font-size: 20px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
    letter-spacing: -1.2px;
    color: black;
}

.dropzone:hover {
    background: #dedcdc;
}
</style>
