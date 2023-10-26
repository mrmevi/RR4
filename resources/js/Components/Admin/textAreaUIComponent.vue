<template>
      <textarea v-model="text" ref="textarea" @input="autoResize" placeholder="Введите максимально-подробное описание поста..."></textarea>
  </template>
  
  <script>
  export default {
    data() {
      return {
        text: ''
      };
    },
    methods: {
      autoResize() {
        this.$refs.textarea.style.height = 'auto';
        this.$refs.textarea.style.height = this.$refs.textarea.scrollHeight + 'px';
        this.$emit('text-updated', this.text);
      },
    }
  };
  </script>