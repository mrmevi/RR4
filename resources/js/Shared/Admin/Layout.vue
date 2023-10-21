<script>
import {defineComponent} from 'vue'
import {Link} from "@inertiajs/vue3";
import route from "ziggy-js";

export default defineComponent({
    methods: {route},
    components: {
        Link
    },
    name: "Layout"
})
</script>

<template>
    <div class="adminLayout">
        <div id="adminLayout__header">
            <div class="adminLayout__header-leftSide">
                рр4 | admin
            </div>
            <div class="adminLayout__header-rightSide">
                <span v-if="$page.props.user">{{ $page.props.user.name }}</span>
                <button v-if="$page.props.user">
                    <Link :href="route('logout')" class="adminLayout__main-sideBar-link">
                        Выйти
                    </Link>
                </button>
                <button v-if="!$page.props.user">
                    <Link :href="route('login.create')" class="adminLayout__main-sideBar-link">
                        Войти
                    </Link>
                </button>
            </div>
        </div>
        <div id="adminLayout__main">
            <div class="adminLayout__main-sideBar">
                <button>
                    <Link class="adminLayout__main-sideBar-link" :href="route('admin.index')">Модерация</Link>
                </button>
                <button>
                    <Link class="adminLayout__main-sideBar-link" :href="route('posts.index')">Посты</Link>
                </button>
                <button>
                    <Link class="adminLayout__main-sideBar-link" :href="route('fish.index')">Рыбы</Link>
                </button>
                <button>
                    <Link class="adminLayout__main-sideBar-link" :href="route('basins.index')">Водоемы</Link>
                </button>
                <button>
                    <Link class="adminLayout__main-sideBar-link" :href="route('users.index')">Пользователи</Link>
                </button>
            </div>
            <div class="content">
                <slot/>
            </div>
        </div>
    </div>
</template>

<style>
* {
    font-family: helvetica;
    padding: 0;
    margin: 0;
}

#adminLayout__header {
    height: 10vh;
    width: 100%;
    background-color: rgba(85, 83, 83, 0.8);
    display: flex;
    align-items: center;
    box-shadow: 0px 5px 5px rgba(85, 83, 83, 0.3);
}

.adminLayout__header-leftSide {
    background-color: rgba(85, 83, 83);
    text-transform: uppercase;
    color: aliceblue;
    font-size: 25px;
    width: 20%;
    height: 100%;
    display: flex;
    align-items: center;
    padding-left: 20px;
    border-right: solid thin rgba(0, 0, 0, 0.2);
}

.adminLayout__header-rightSide {
    position: relative;
    left: auto;
    right: 0px;
    margin-left: auto;
    width: auto;
    display: flex;
    align-items: center;
    font-size: 20px;
    width: 80%;
    justify-content: end;
}

.adminLayout__header-rightSide button {
    color: var(--Black, #2F2F2F);
    font-size: 20px;
    font-style: normal;
    font-weight: 500;
    line-height: 120%;
    background-color: inherit;
    border: none;
    margin-inline: 30px;
}

#adminLayout__main {
    height: 90vh;
    width: 100%;
    display: flex;
}

.adminLayout__main-sideBar {
    width: 20%;
    height: 90vh;
    padding-left: 20px;
    border-right: solid thin rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 10px
}

.adminLayout__main-sideBar button {
    margin-top: 20px;
    color: var(--Black, #076a9f);
    font-size: 20px;
    font-style: normal;
    font-weight: 500;
    line-height: 120%;
    background-color: inherit;
    border: none;
    text-transform: capitalize;
}

.adminLayout__main-sideBar-link {
    color: black;
    text-decoration: none;
}

.content {
    height: 100%;
    width: 80%;
    flex-direction: column;
    display: flex;

}

.adminLayout__main-nameOption {
    width: 95%;
    height: 10%;
    font-size: 20px;
    border-bottom: solid thin rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    margin-left: auto;
    margin-right: auto;
    justify-content: space-between;
}

.adminLayout__main-nameOption span {
    margin-left: 30px;
}

.adminLayout__main-content {
    height: 80%;
    width: 95%;
    margin-top: 20px;
    margin-left: auto;
    margin-right: auto;

}

.adminLayout__main-content-table {
    height: auto;
    width: 100%;
    text-align: center;
}

.adminLayout__main-content-table td {
    height: fit-content;
    width: fit-content;
    border-bottom: solid 1px;
    padding: 5px;
}

td button {
    border: none;
    margin-inline: 10px;
    background: none;
}

.manageInfo {
    align-self: self-end;
    width: 15%;
}
</style>
