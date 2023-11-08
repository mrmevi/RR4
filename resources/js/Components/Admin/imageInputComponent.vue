<template>
  <link rel="stylesheet" :href="stylePathToAddImageField">
  <div class="imageImputComponent">
    <div class="imageImputComponent__addBtn">
      <input type="file" name="files[]" id="upload-file__input_1" class="imageImputComponent__addBtn_input"
        accept=".jpg, .jpeg, .png, .gif, .bmp" @change="handleFileUpload" multiple>
      <label class="imageImputComponent__addBtn_input_label" for="upload-file__input_1">
        <svg width="60px" height="60px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect width="24" height="24" fill="white" />
          <path d="M12 6V18" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M6 12H18" stroke="#000000" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
        <span>Выберете файл</span>
      </label>
    </div>
    <div class="imageImputComponent__dropZone" @dragover="handleDragOver" @drop="handleDrop">
      <input type="file" ref="fileInput" style="display: none" accept="image/*">
      <div class="imageImputComponent__dropZone_magePreviewField" 
      v-for="(image, index) in images" 
      :key="index"
        @mouseover="upPanel = index"
         @mouseleave="upPanel = null"
         >
        <img :src="image.url" :alt="image.name"
          :class="{ 'imageImputComponent__dropZone_magePreviewField-greenBorder': index === selectedImageIndex }">
        <div class="imageImputComponent__dropZone_magePreviewField-deleteIcon" @click="deleteImage(index)">
          ✕</div>
        <div class='imageImputComponent__dropZone_magePreviewField-panel' v-if="upPanel === index">
          <img src="../../../assets/img/shared.png" :alt="image.name" @click="toggleFullscreen(image)">
          <img src="../../../assets/img/tick.png" :alt="image.name" @click="selectImage(index)">
        </div>
      </div>
      <div class="imageImputComponent__dropZone-text">
        <span>Или перетащите его в эту область</span>
      </div>
    </div>
    <div v-if="showModal" class="modal">
      <div class="modal-content">
        <img :src="selectedImage.url" :alt="selectedImage.name" class="modal-image">
        <button class="modal-close" @click="toggleModal">Закрыть</button>
      </div>
    </div>
  </div>
</template>

<script>

export default ({
  name: "imageInputComponent",
  props: {
    stylePathToAddImageField: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      images: [],
      upPanel: false,
      selectedImageIndex: null,
      showModal: false,
      selectedImage: {}
    }
  },
  methods: {
    handleFileUpload(event) {
      const files = event.target.files;
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();
        reader.onload = () => {
          this.images.push({
            url: reader.result,
            name: file.name,
          });
        };
        reader.readAsDataURL(file);
      }
    },
    deleteImage(index) {
      this.images.splice(index, 1);
    },
    selectImage(index) {
      this.selectedImageIndex = index;
    },
    toggleFullscreen(image) {
      this.selectedImage = image;
      this.showModal = true;
    },
    toggleModal() {
      this.showModal = !this.showModal;
    },
    handleDragOver(event) {
      event.preventDefault();
    },
    handleDrop(event) {
      event.preventDefault();
      const files = event.dataTransfer.files;
      for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();
        reader.onload = () => {
          this.images.push({
            url: reader.result,
            name: file.name,
          });
        };
        reader.readAsDataURL(file);
      }
    },
    handleFileChange(event) {
      const file = event.target.files[0];
      const reader = new FileReader();
      reader.onload = () => {
        this.images.push({
          url: reader.result,
          name: file.name,
        });
      };
      reader.readAsDataURL(file);
    },
  },
})
</script>

