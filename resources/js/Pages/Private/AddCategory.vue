<template>
  <div>
    <div
      class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400"
    >
      <div class="-mx-3 md:flex mb-6">
        <div class="md:w-1/2 px-3 mb-6 md:mb-0 md:ml-[25%]">
          <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">
            {{ category[0] ? "Update Category" : "Create Category" }}
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
import { useForm, usePage } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";
const props = defineProps({
  category: Object,
});
// set page to expose page props
const page = usePage();

// Use category props
const { category } = toRefs(props);

// const form = reactive({
//   title: category.value[0]?.title,
//   description: category.value[0]?.description,
// });

const form = useForm({
  title: category.value[0]?.title,
  description: category.value[0]?.description,
  _method: category.value[0] ? "put" : null,
});

// creat create or update category with form data
const submitForm = () => {
  // Send Edit request if id exist
  if (category.value[0]) {
    form._method = "PUT";
    form.put(`/dashboard/category/${category.value[0].id}`, {
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
    form.post("/dashboard/category", {
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
