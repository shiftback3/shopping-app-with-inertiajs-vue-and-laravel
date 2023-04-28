<script setup>
import MainNavbar from "../../Components/MainNavbar.vue";
import ProductDetails from "../../Components/ProductDetails.vue";

defineProps({ product: Object });
</script>

<template>
  <MainNavbar />
  <main>
    <ProductDetails :product="product" />
  </main>
</template>
