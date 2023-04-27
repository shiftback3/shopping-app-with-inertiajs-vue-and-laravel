<template>
  <header class="bg-white">
    <nav
      class="fixed top-0 inset-x-0 z-40 bg-white mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8"
      aria-label="Global"
    >
      <div class="flex lg:flex-1">
        <Link href="#" class="-m-1.5 p-1.5">
          <span class="sr-only">Your Company</span>
          <img class="h-8 w-auto" src="../../images/sample-logo.png" alt="" />
        </Link>
      </div>

      <div class="flex lg:hidden">
        <a
          @click="handleChildUpdate(true)"
          href="#"
          class="icon-cart text-sm font-semibold leading-6 text-gray-900"
        >
          <ShoppingBagIcon class="h-6 w-6 text-blue-500" />
          <span class="count-cart">{{ cartStore.totalQuantity }}</span>
        </a>
        <button
          type="button"
          class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 mx-1"
          @click="mobileMenuOpen = true"
        >
          <span class="sr-only">Open main menu</span>
          <Bars3Icon class="h-6 w-6" aria-hidden="true" />
        </button>
      </div>
      <PopoverGroup class="hidden lg:flex lg:gap-x-12">
        <Link :href="route('home')" class="text-sm font-semibold leading-6 text-gray-900"
          >Products</Link
        >
        <Link href="#" class="text-sm font-semibold leading-6 text-gray-900">Cart</Link>
        <Link href="#" class="text-sm font-semibold leading-6 text-gray-900"
          >Categories</Link
        >
      </PopoverGroup>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a
          @click="handleChildUpdate(true)"
          href="#"
          class="icon-cart text-sm font-semibold leading-6 text-gray-900"
        >
          <ShoppingBagIcon class="h-6 w-6 text-blue-500" />
          <span class="count-cart">{{ cartStore.totalQuantity }}</span>
        </a>
        <span class="mx-4">|</span>
        <Link
          :href="route('login.show')"
          class="text-sm font-semibold leading-6 text-gray-900"
          >Log in
        </Link>
        <span class="mx-4">|</span>
        <Link
          :href="route('register.show')"
          class="text-sm font-semibold leading-6 text-gray-900"
          >Register</Link
        >
      </div>
    </nav>

    <Dialog
      as="div"
      class="lg:hidden"
      @close="mobileMenuOpen = false"
      :open="mobileMenuOpen"
    >
      <div class="fixed inset-0 z-10" />
      <DialogPanel
        class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10"
      >
        <div class="flex items-center justify-between">
          <Link href="#" class="-m-1.5 p-1.5">
            <span class="sr-only">Your Company</span>
            <img class="h-8 w-auto" src="../../images/sample-logo.png" alt="" />
          </Link>
          <button
            type="button"
            class="-m-2.5 rounded-md p-2.5 text-gray-700"
            @click="mobileMenuOpen = false"
          >
            <span class="sr-only">Close menu</span>
            <XMarkIcon class="h-6 w-6" aria-hidden="true" />
          </button>
        </div>
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <Link
                :href="route('home')"
                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                >Products</Link
              >
              <Link
                href="#"
                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                >Cart</Link
              >
              <Link
                href="#"
                class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                >Categories</Link
              >
            </div>
            <div class="py-6">
              <Link
                :href="route('login.show')"
                class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                >Log in</Link
              >
              <Link
                :href="route('register.show')"
                class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50"
                >Register</Link
              >
            </div>
          </div>
        </div>
      </DialogPanel>
    </Dialog>
    <ShoppingCart :open="parentState" @updateState="handleChildUpdate(false)" />
  </header>
</template>

<script setup>
import { ref, computed } from "vue";
import { Link } from "@inertiajs/vue3";
import ShoppingCart from "../Components/ShoppingCart.vue";
import {
  Dialog,
  DialogPanel,
  Disclosure,
  DisclosureButton,
  DisclosurePanel,
  Popover,
  PopoverButton,
  PopoverGroup,
  PopoverPanel,
} from "@headlessui/vue";
import {
  ArrowPathIcon,
  Bars3Icon,
  ChartPieIcon,
  CursorArrowRaysIcon,
  FingerPrintIcon,
  SquaresPlusIcon,
  XMarkIcon,
  ShoppingBagIcon,
} from "@heroicons/vue/24/outline";
import { ChevronDownIcon, PhoneIcon, PlayCircleIcon } from "@heroicons/vue/20/solid";

import { useCartStore } from "@/store/cart";

// set the Cart display to false by default
const parentState = ref(false);

// Update the state of the cart either true | false
function handleChildUpdate(value) {
  parentState.value = value;
}

// Define the cart store
const cartStore = useCartStore();

// Initialize mobile Menu to false by default
const mobileMenuOpen = ref(false);
</script>

<style scoped>
.icon-cart {
  position: relative;
}
/* style the counter tag */
.count-cart {
  position: absolute;
  left: 60%;
  top: 0%;
  font-size: 55%;
  padding: 0.6em;
  border-radius: 999px;
  line-height: 0.75em;
  color: white;
  text-align: center;
  min-width: 2em;
  font-weight: bold;
  background: red;
  border-style: solid;
}
</style>
