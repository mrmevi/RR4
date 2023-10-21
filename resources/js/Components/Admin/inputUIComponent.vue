<template>
    <input list="list" v-model="selectedValue" @change="changeItem">
    <datalist id="list">
        <option v-for="(value, key) in arrayFindID" :key="key">{{ value }}</option>
    </datalist>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    name: "Create",
    props: {
        arrayFindID: {
            type: Array,
            required: true
        }
    },
    methods: {
        changeItem() {
            const selectedKey = Object.keys(this.arrayFindID).find(key => this.arrayFindID[key] === this.selectedValue);
            this.$emit('item-changed', selectedKey);
        }
    },
    data() {
        return {
            selectedValue: '',
        }
    },
})
</script>


