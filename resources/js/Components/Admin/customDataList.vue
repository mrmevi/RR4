<template>
    <link rel="stylesheet" :href="stylePath">
    <div class="customDataList" ref="customDataList">
        <input class="customDataList" :list="listId" type="text" v-model="selectedOption" @click="filterOptions"
            @input="filterOptions">
        <ul :list="listId" v-show="showOptions">
            <li v-for="(value, key) in filteredOptions" :key="key" @click="selectOption(value)">{{ value }}</li>
        </ul>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
export default defineComponent({
    name: "customDataList",
    props: {
        arrayFindID: {
            type: Object,
            required: true
        },
        listId: {
            type: [String, Number],
            default: () => Date.now(),
        },
        stylePath: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            selectedOption: '',
            showOptions: false,
        };
    },
    mounted() {
        window.addEventListener('click', this.handleClickOutside);
    },
    beforeUnmount() {
        window.removeEventListener('click', this.handleClickOutside);
    },
    computed: {
        filteredOptions() {
            if (typeof this.arrayFindID === 'object' && this.arrayFindID !== null) {
                return Object.values(this.arrayFindID).filter(value => value.toLowerCase().includes(this.selectedOption.toLowerCase()));
            } else {
                return [];
            }
        }
    },
    methods: {
        addOption() {
            this.selectedOption = this.value
        },
        filterOptions() {
            this.showOptions = true;
        },
        selectOption(option) {
            this.selectedOption = option;
            this.showOptions = false;
            this.$emit('item-changed', option);
        },
        handleClickOutside(event) {
            if (this.$refs.customDataList && !this.$refs.customDataList.contains(event.target)) {
                this.showOptions = false;
            }
        }
    }
})
</script>