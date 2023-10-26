<template>
    <input :list="listId" v-model="selectedValue" @change="changeItem" placeholder="Введите и выберите один из вариантов..">
    <datalist :id="listId">
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
        },
        listId: {
      type: [String, Number],
      default: () => Date.now(),
    },
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
