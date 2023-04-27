<template>
  <div>
    <h1 class="text-2xl font-bold mb-4">Add Product</h1>

    <form @submit.prevent="submitForm">
      <div class="mb-4">
        <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
        <input id="name" type="text" v-model="form.name" class="form-input w-full" />
      </div>

      <div class="mb-4">
        <label for="description" class="block text-gray-700 font-bold mb-2"
          >Description</label
        >
        <textarea
          id="description"
          v-model="form.description"
          class="form-textarea w-full"
        ></textarea>
      </div>

      <div class="mb-4">
        <label for="tags" class="block text-gray-700 font-bold mb-2">Tags</label>
        <input id="tags" type="text" v-model="form.tags" class="form-input w-full" />
      </div>

      <div class="mb-4">
        <label for="images" class="block text-gray-700 font-bold mb-2">Images</label>
        <input
          id="images"
          type="file"
          multiple
          @change="handleImageChange"
          class="form-input w-full"
        />
        <div v-if="form.images.length > 0" class="mt-2">
          <div
            v-for="(image, index) in form.images"
            :key="index"
            class="flex items-center"
          >
            <img :src="image" class="h-12 w-12 object-cover rounded-full" />
            <button type="button" @click="removeImage(index)" class="ml-2">Remove</button>
          </div>
        </div>
      </div>

      <button
        type="submit"
        class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-blue-600"
      >
        Save
      </button>
    </form>
  </div>
</template>

<script>
import { reactive, ref } from "vue";
import { router } from "@inertiajs/vue3";

export default {
  setup() {
    const form = reactive({
      name: "",
      description: "",
      tags: "",
      images: [],
    });

    const imageFiles = ref([]);

    function handleImageChange(event) {
      const files = event.target.files;
      imageFiles.value = Array.from(files);

      const reader = new FileReader();

      reader.onload = () => {
        form.images.push(reader.result);
      };

      imageFiles.value.forEach((file) => {
        reader.readAsDataURL(file);
      });
    }

    function removeImage(index) {
      form.images.splice(index, 1);
      imageFiles.value.splice(index, 1);
    }

    function submitForm() {
      const formData = new FormData();

      formData.append("name", form.name);
      formData.append("description", form.description);
      formData.append("tags", form.tags);

      imageFiles.value.forEach((file) => {
        formData.append("images[]", file);
      });

      router.post("/products", formData);
    }

    return {
      form,
      handleImageChange,
      removeImage,
      submitForm,
    };
  },
};
</script>
