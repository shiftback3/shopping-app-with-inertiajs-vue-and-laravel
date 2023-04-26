<script setup>
import MainNavbar from "../../Components/MainNavbar.vue";
import ProductDetails from "../../Components/ProductDetails.vue";

defineProps({ name: String });
</script>

<template>
  <MainNavbar />
  <main>
    <ProductDetails />
  </main>
</template>
