<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "MainSearchComponent"
})
</script>

<template>
    <div class="filtersComponent">
        <div class="filtersComponent__containerFilters">
            <div class="filtersComponent__containerFilters_fish">
                <span>Вид рыбы</span>
                <input type="text" list="cars" />
                <datalist id="cars">
                    <option>Mercedes</option>
                    <option>Audi</option>
                </datalist>
            </div>
            <div class="filtersComponent__containerFilters_basins">
                <span>Водоём</span>
                <input type="text" list="cars" />
                <datalist id="cars">
                    <option>Volvo</option>
                    <option>Saab</option>
                    <option>Mercedes</option>
                    <option>Audi</option>
                </datalist>
            </div>
            <button>ПОИСК</button>
        </div>
    </div>
</template>

<style>
.filtersComponent {
    width: 100%;
    height: 70vh;
    background-image: url(/resources/assets/img/bg.jpg);
    background-size: 100% 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    background-repeat: no-repeat;
}

.filtersComponent__containerFilters {
    height: 15%;
    width: 70%;
    background-color: rgb(255, 255, 255);
    display: flex;
    border: solid 1px;
    border-radius: 20px;
}

.filtersComponent__containerFilters_fish {
    width: 70%;
    text-align: left;
    padding: 10px;
    margin-left: 10px;
}

.filtersComponent__containerFilters_basins {
    width: 70%;
    text-align: left;
    padding: 10px;
    margin-left: 10px;
}

span {
    font-size: 17px;
    margin-bottom: 5px;
}

input {
    height: 50%;
    width: 80%;
    background-color: inherit;
    border: solid 1px;
    display: block;
    padding: 2px 0px 2px 2px;
    border-radius: 5px;
}


.filtersComponent__containerFilters button {
    color: var(--Black, #0060c7);
    font-family: Montserrat;
    font-size: 20px;
    font-style: normal;
    font-weight: 500;
    line-height: 120%;
    background-color: inherit;
    border: none;
    white-space: nowrap;
    width: 20%;
    margin-right: 30px;
    text-align: center;
}
</style>
