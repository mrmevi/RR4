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
    props:{
        basin: Object,
    },
    setup(props){
        const form = useForm({
            title: props.basin.title,
        });
        function update(){
            form.put(route('basins.update', props.basin.id))
        }

        return {form, update};
    },
    name: "Create"
})
</script>

<template>
    <Head>
        <title>Admin | Водоемы | Изменение</title>
    </Head>
    <Layout>
        <div class="adminLayout__main-nameOption">
            <span>Форма изменения водоема</span>
            <BackButton></BackButton>
        </div>
        <div class="form__fish">
            <form @submit.prevent="update">
                <div class="form__fish-title">
                    <span class="">Название водоема:</span>
                    <input v-model="form.title">
                </div>
                <div class="form__fish-submit">
                    <button type="submit">
                        Изменить
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
.form__fish-submit{
    padding-top: 30px;
}
.form__fish-submit button{
    width: 140px;
    height: 40px;
    border-radius: 16px;
    border: 2px solid chocolate;
    background-color: coral;
    opacity: 80%;

}
.form__fish-submit button:hover{
    color: white;
}
</style>
