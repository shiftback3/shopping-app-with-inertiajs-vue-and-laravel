<template>
  <TransitionRoot as="template" :show="open" class="z-50">
    <Dialog as="div" class="relative z-10" @close="updateParentState">
      <TransitionChild
        as="template"
        enter="ease-in-out duration-500"
        enter-from="opacity-0"
        enter-to="opacity-100"
        leave="ease-in-out duration-500"
        leave-from="opacity-100"
        leave-to="opacity-0"
      >
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
          <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
            <TransitionChild
              as="template"
              enter="transform transition ease-in-out duration-500 sm:duration-700"
              enter-from="translate-x-full"
              enter-to="translate-x-0"
              leave="transform transition ease-in-out duration-500 sm:duration-700"
              leave-from="translate-x-0"
              leave-to="translate-x-full"
            >
              <DialogPanel class="pointer-events-auto w-screen max-w-md">
                <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                  <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                    <div class="flex items-start justify-between">
                      <DialogTitle class="text-lg font-medium text-gray-900"
                        >Shopping cart ({{ cartStore.totalQuantity }})</DialogTitle
                      >
                      <div class="ml-3 flex h-7 items-center">
                        <button
                          type="button"
                          class="-m-2 p-2 text-gray-400 hover:text-gray-500"
                          @click="updateParentState"
                        >
                          <span class="sr-only">Close panel</span>
                          <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                        </button>
                      </div>
                    </div>

                    <div class="mt-8">
                      <div class="flow-root">
                        <div v-if="products.length < 1">Your Cart is Empty!</div>
                        <ul
                          v-if="products"
                          role="list"
                          class="-my-6 divide-y divide-gray-200"
                        >
                          <li
                            v-for="product in products"
                            :key="product.id"
                            class="flex py-6"
                          >
                            <div
                              class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200"
                            >
                              <img
                                :src="product.imageSrc"
                                :alt="product.imageAlt"
                                class="h-full w-full object-cover object-center"
                              />
                            </div>

                            <div class="ml-4 flex flex-1 flex-col">
                              <div>
                                <div
                                  class="flex justify-between text-base font-medium text-gray-900"
                                >
                                  <h3>
                                    <a :href="product.href">{{ product.name }}</a>
                                  </h3>
                                  <p class="ml-4">$ {{ product.price }}</p>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">
                                  {{ product.color }}
                                </p>
                              </div>
                              <div class="flex flex-1 items-end justify-between text-sm">
                                <div class="number">
                                  <span
                                    @click="removeSingle(product)"
                                    role="button"
                                    class="minus"
                                    ><MinusIcon
                                  /></span>
                                  <input type="text" :value="product.quantity" />
                                  <span
                                    @click="addToCart(product)"
                                    role="button"
                                    class="plus"
                                    ><PlusIcon
                                  /></span>
                                </div>

                                <div class="flex"></div>
                              </div>
                              <div class="flex flex-1 items-end justify-between text-sm">
                                <p class="text-gray-500">Qty {{ product.quantity }}</p>

                                <TrashIcon
                                  @click="removeItem(product)"
                                  role="button"
                                  class="text-red-600 hover:text-red-500 w-6 h-6 cursor-pointer"
                                />
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>

                  <div class="border-t border-gray-200 px-4 py-6 sm:px-6">
                    <div class="flex justify-between text-base font-medium text-gray-900">
                      <p>Subtotal</p>
                      <p>${{ cartStore.subTotal }}</p>
                    </div>
                    <p class="mt-0.5 text-sm text-gray-500">
                      Shipping and taxes calculated at checkout.
                    </p>
                    <div class="mt-6">
                      <a
                        href="#"
                        class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700"
                        >Checkout</a
                      >
                    </div>
                    <div
                      class="mt-6 flex justify-center text-center text-sm text-gray-500"
                    >
                      <p>
                        or
                        <button
                          type="button"
                          class="font-medium text-indigo-600 hover:text-indigo-500"
                          @click="open = false"
                        >
                          Continue Shopping
                          <span aria-hidden="true"> &rarr;</span>
                        </button>
                      </p>
                    </div>
                  </div>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>

<script setup>
import { ref } from "vue";
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
import { XMarkIcon, PlusIcon, MinusIcon, TrashIcon } from "@heroicons/vue/24/outline";
import { useCartStore } from "@/store/cart";
import { toast } from "vue3-toastify";
import "vue3-toastify/dist/index.css";

import { defineEmits } from "vue";
// Initialize emit value
const emit = defineEmits(["updateState"]);

// This function update the Parent state
const updateParentState = () => {
  emit("updateState", false);
};
// Defind Props that will be gotten from parent to set state to true or false
defineProps({
  open: Boolean,
});

// Define the cart store
const cartStore = useCartStore();
// Load the product in the cart view
const products = cartStore.items;

// Add item to cart
const addToCart = (product) => {
  cartStore.addToCart(product);
  toast.success("Cart updated Successfully!", {
    autoClose: 1000,
  }); // ToastOptions
};

// Function to remove a particular product (plus quantity)
function removeItem(item) {
  cartStore.removeFromCart(item);
  toast.success("Cart updated Successfully!", {
    autoClose: 1000,
  }); // ToastOptions
}

// Function to remove an item (only quantity)
function removeSingle(item) {
  cartStore.removeSingleFromCart(item);
  toast.success("Cart updated Successfully!", {
    autoClose: 1000,
  }); // ToastOptions
}
</script>

<style scoped>
.minus,
.plus {
  width: 34px;
  height: 34px;
  background: #f2f2f2;
  border-radius: 4px;
  padding: 8px 5px 8px 5px;
  border: 1px solid #ddd;
  display: inline-block;
  vertical-align: middle;
  text-align: center;
  margin: 5px;
}
input {
  height: 34px;
  width: 50px;
  text-align: center;
  font-size: 20px;
  border: 1px solid #ddd;
  border-radius: 4px;
  display: inline-block;
  vertical-align: middle;
}
</style>
