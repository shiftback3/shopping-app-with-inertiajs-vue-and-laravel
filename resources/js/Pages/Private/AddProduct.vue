<template>
  <div>
    <div
      class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400"
    >
      <div class="-mx-3 md:flex mb-6">
        <div class="md:w-1/2 px-3 mb-6 md:mb-0 md:ml-[25%]">
          <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">
            {{ products[0] ? "Update products" : "Create products" }}
          </h1>
          <form @submit.prevent="submitForm()">
            <div>
              <label
                for="title"
                class="text-gray-800 text-sm font-bold leading-tight tracking-normal"
                >Title</label
              >

              <input
                id="title"
                class="mb-3 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                placeholder="Title"
                v-model="form.title"
              />
              <span v-if="$page.props.errors.title" class="text-red-800 text-sm">
                {{ $page.props.errors.title }}
              </span>
            </div>
            <div>
              <label
                for="Description"
                class="text-gray-800 text-sm font-bold leading-tight tracking-normal"
                >Description</label
              >
              <input
                id="description"
                class="mb-3 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                placeholder="description"
                v-model="form.description"
              />
              <span v-if="$page.props.errors.description" class="text-red-800 text-sm">
                {{ $page.props.errors.description }}
              </span>
            </div>

            <div>
              <label
                for="Description"
                class="text-gray-800 text-sm font-bold leading-tight tracking-normal"
                >Category</label
              >
              <select
                id="category_id"
                class="mb-3 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                placeholder="description"
                v-model="form.category_id"
              >
                <option>Select Category</option>
                <option v-for="(item, index) in categories" :key="index" :value="item.id">
                  {{ item.title }}
                </option>
              </select>
              <span v-if="$page.props.errors.category_id" class="text-red-800 text-sm">
                {{ $page.props.errors.category_id }}
              </span>
            </div>

            <div>
              <label
                for="Description"
                class="text-gray-800 text-sm font-bold leading-tight tracking-normal"
                >Price</label
              >
              <input
                id="price"
                class="mb-3 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                placeholder="price"
                v-model="form.price"
                type="number"
              />
              <span v-if="$page.props.errors.price" class="text-red-800 text-sm">
                {{ $page.props.errors.price }}
              </span>
            </div>

            <div>
              <label
                for="Description"
                class="text-gray-800 text-sm font-bold leading-tight tracking-normal"
                >Quantity</label
              >
              <input
                id="quantity"
                class="mb-3 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border"
                placeholder="quantity"
                v-model="form.quantity"
                type="number"
              />
              <span v-if="$page.props.errors.quantity" class="text-red-800 text-sm">
                {{ $page.props.errors.quantity }}
              </span>
            </div>

            <div class="mb-4">
              <label for="images" class="block text-gray-700 font-bold mb-2"
                >Images</label
              >
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
                  <button type="button" @click="removeImage(index)" class="ml-2">
                    Remove
                  </button>
                </div>
              </div>
            </div>
            <div class="flex items-center justify-start w-full">
              <button
                type="submit"
                class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm"
              >
                Submit
              </button>
              <button
                class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm"
                @click="back"
              >
                Cancel
              </button>
            </div>
            <XMarkIcon
              class="w-5 cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600"
              @click="back"
              aria-label="close modal"
              role="button"
            />
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { XMarkIcon } from "@heroicons/vue/24/outline";
import { ref, toRefs, reactive } from "vue";
import { useForm, usePage, router } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
const props = defineProps({
  products: Object,
  categories: Object,
});
// set page to expose page props
const page = usePage();

// Useproducts props
const { products } = toRefs(props);

// const form = reactive({
//   title:products.value[0]?.title,
//   description:products.value[0]?.description,
// });

const form = reactive({
  title: products.value[0]?.title,
  description: products.value[0]?.description,
  category_id: products.value[0]?.category_id,
  price: products.value[0]?.price,
  quantity: products.value[0]?.quantity,
  images: [],
  // _method: products.value[0] ? "put" : null,
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
// creat create or updateproducts with form data
const submitForm = () => {
  const formData = new FormData();

  formData.append("title", form.title);
  formData.append("description", form.description);
  formData.append("price", form.price);
  formData.append("category_id", form.category_id);
  formData.append("quantity", form.quantity);
  imageFiles.value.forEach((file) => {
    formData.append("images[]", file);
  });

  // Send Edit request if id exist
  if (products.value[0]) {
    router.post(`/dashboard/product/${products.value[0].id}`, formData, {
      preserveScroll: true,
      onSuccess: () => {
        toast.success(page.props.flash.notification.message, {
          autoClose: 1000,
        }); // ToastOptions,
        // Reset the form...
        form.reset();
      },
    });
  } else {
    // create new ...
    router.post("/dashboard/product", formData, {
      preserveScroll: true,
      onSuccess: () => {
        toast.success(page.props.flash.notification.message, {
          autoClose: 1000,
        }); // ToastOptions,

        // Reset the form...
        form.reset();
      },
    });
  }
};

const back = () => {
  window.history.back();
};
</script>
