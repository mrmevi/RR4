<script>
import {defineComponent} from 'vue'
import Layout from "@/Shared/Admin/Layout.vue";
import {Head, useForm} from "@inertiajs/vue3";
import BackButton from "@/Components/Admin/button/BackButton.vue";
import route from "ziggy-js";


export default defineComponent({
    components: {
        BackButton,
        Head,
        Layout,
    },
    setup(){
        const form = useForm({
            title: null,
            simple: null,
            zachet: null,
            chat: null,
            trophy: null,
            rareTrophy: null,
        });
        function store(){
            form.post(route('fish.store'))
        }

        return {form, store};
    },
    name: "Create"
})
</script>

<template>
    <Head>
        <title>Admin | Рыбы | Создание</title>
    </Head>
    <Layout>
        <div class="adminLayout__main-nameOption">
            <span>Форма добавления наименования рыбы</span>
            <BackButton></BackButton>
        </div>
        <div class="form__fish">
            <form @submit.prevent="store">
                <div class="form__fish-title">
                    <span class="">Наименование рыбы:</span>
                    <input v-model="form.title">
                </div>
                <div class="form__fish-weight">
                    <span class="">Веса:</span>
                </div>
                <div class="form__fish-information1">
                    <div class="weight">
                        <span class="">Не зачетная:</span>
                        <input v-model="form.simple" type="number" step=0.001>
                    </div>
                    <div class="weight">
                        <span class="">Зачетная:</span>
                        <input list="basins" v-model="form.zachet" type="number" step=0.001>
                    </div>
                    <div class="weight">
                        <span class="">Чатовая:</span>
                        <input list="fish" v-model="form.chat" type="number" step=0.001>
                    </div>
                </div>
                <div class="form__fish-information2">
                    <div class="weight">
                        <span class="">Трофей:</span>
                        <input v-model="form.trophy" type="number" step=0.001>
                    </div>
                    <div class="weight">
                        <span class="">Редкий трофей:</span>
                        <input list="basins" v-model="form.rareTrophy" type="number" step=0.001>
                    </div>
                </div>
                <div class="form__fish-submit">
                    <button type="submit">
                        Добавить
                    </button>
                </div>
            </form>
        </div>
    </Layout>
</template>

<style scoped>
.form__fish {
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

.form__fish-title {
    display: flex;
    width: 1196px;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
}
.form__fish-weight{
    padding-top: 20px;
}
.form__fish-information1 {
    padding-top: 20px;
    display: inline-flex;
    align-items: flex-start;
    gap: 25px;
}
.form__fish-information2 {
    padding-top: 20px;
    display: inline-flex;
    align-items: flex-start;
    gap: 25px;
}
.weight {
    display: flex;
    width: 382px;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
}
.form__fish-submit{
    padding-top: 30px;
}
.form__fish-submit button{
    width: 140px;
    height: 40px;
    border-radius: 16px;
    border: 2px solid #249112;
    background: rgba(94, 232, 99, 0.81);
}
.form__fish-submit button:hover{
    color: white;
}
</style>
