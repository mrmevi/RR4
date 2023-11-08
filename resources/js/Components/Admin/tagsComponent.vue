<template>
    <link rel="stylesheet" :href="stylePathToTagsComponent">
    <div class="tagsComponent">
      
    </div>
  </template>
  
  <script>
  
  export default ({
    name: "tagsComponent",
    props: {
      stylePathToTagsComponent: {
        type: String,
        required: true
      }
    },
    data() {
      return {
       
      }
    },
  })
  </script>
  
  