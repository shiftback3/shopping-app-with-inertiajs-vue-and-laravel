<template>
  <div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
      <h2 class="sr-only">Products</h2>

      <div
        class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8"
      >
        <div
          v-for="product in data"
          :key="product.id"
          class="group bg-white shadow-md hover:scale-105 hover:shadow-xl duration-500"
        >
          <div
            role="button"
            class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg xl:aspect-h-8 xl:aspect-w-7"
          >
            <Link :href="route('product.details', product.id)">
              <img
                :src="product.imageSrc"
                :alt="product.imageAlt"
                class="h-full w-full object-cover object-center group-hover:opacity-75"
              />
            </Link>
          </div>
          <Link :href="route('product.details', product.id)">
            <h3 class="mt-4 text-lg font-semibold text-gray-800 my-3 ml-4">
              {{ product.name }}
            </h3>
          </Link>
          <div class="flex items-center mx-4 mb-6">
            <p class="mt-1 text-lg font-medium text-gray-900">$ {{ product.price }}</p>
            <div
              @click="addToCart(product)"
              class="ml-auto"
              title="add to cart"
              role="button"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                fill="currentColor"
                class="bi bi-bag-plus"
                viewBox="0 0 16 16"
              >
                <path
                  fill-rule="evenodd"
                  d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"
                />
                <path
                  d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z"
                />
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, toRefs } from "vue";
import { useCartStore } from "@/store/cart";
import { Link } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

const props = defineProps({
  products: Object,
});

// Use products props
const { products } = toRefs(props);

/* Using array Map function to covert the data to 
match what I have on the frontend design and it also allows me to define 
some default data that is not in the DB */

const data = products.value.map((item) => {
  const result = {
    id: item.id,
    name: item.title,
    price: item.price,
    rating: 3.9,
    reviewCount: 117,
    href: "#",
    imageSrc: item.images[0]
      ? `/storage/${item.images[0]?.filename}`
      : "https://mtek3d.com/wp-content/uploads/2018/01/image-placeholder-500x500.jpg",
    imageAlt: item.slug,
  };
  return result;
});

// Define the cart store
const cartStore = useCartStore();
// Add item to cart
const addToCart = (product) => {
  cartStore.addToCart(product);
  toast.success("Cart updated Successfully!", {
    autoClose: 1000,
  }); // ToastOptions
};
</script>
