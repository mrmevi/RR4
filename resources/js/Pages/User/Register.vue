<script>
import {defineComponent} from 'vue'
import {useForm} from "@inertiajs/vue3";
import route from "ziggy-js";

export default defineComponent({
    setup(){
        const form = useForm({
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
        });
        function store(){
            form.post(route('register'))
        }
        return {form, store};
    },
    name: "Register"
})
</script>

<template>
    <form @submit.prevent="store">
        <div class="container">
            <div class="form__title">
                <span>RR4 | Регистрация</span>
            </div>
            <div class="form__data">
                <div class="form__data-input">
                    <span>Введите имя:</span>
                    <input v-model="form.name" type="text">
                </div>
                <div class="form__data-input">
                    <span>Введите почту:</span>
                    <input v-model="form.email" type="email">
                </div>
                <div class="form__data-input">
                    <span>Введите пароль:</span>
                    <input type="password" v-model="form.password">
                </div>
                <div class="form__data-input">
                    <span>Повторите пароль:</span>
                    <input v-model="form.password_confirmation" type="password" name="password_confirmation">
                </div>
            </div>
            <div class="form__submit">
                <button type="submit">
                    Зарегистрироваться
                </button>
            </div>
        </div>
    </form>
</template>

<style scoped>
* {
    padding: 0;
    margin: 0;
    font-family: helvetica;
}

.container {
    height: auto;
    display: flex;
    padding: 40px 120px;
    flex-direction: column;
    align-items: center;
    border-radius: 60px;
    background: #FFF;
}
.form__title span {
    color: #202020;
    font-size: 30px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    letter-spacing: -1.8px;
}

.form__data {
    padding-top: 40px;
    display: flex;
    width: 480px;
    flex-direction: column;
    align-items: flex-start;
    gap: 40px;
}

.form__data-input {
    display: flex;
    width: 479px;
    align-items: flex-start;
    flex-direction: column;
    gap: 10px;
    flex-shrink: 0;
}
.form__data-input span{
    color: #202020;
    font-size: 20px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    letter-spacing: -1.2px;
}
.form__data-input input{
    height: 40px;
    align-self: stretch;
    border-radius: 20px;
    border: none;
    background: #F5F5F5;
    padding-left: 30px;
}
.form__data-input input:focus{
    border: 1px solid grey;
    outline: none;
    padding-left: 30px;
}
.form__submit{
    padding-top: 50px;
}
.form__submit button{
    display: flex;
    width: 350px;
    height: 60px;
    justify-content: center;
    align-items: center;
    border-radius: 20px;
    background: #3C32AC;
    color: #F5F5F5;
}
</style>
