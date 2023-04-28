<script setup>
import MainNavbar from "../../Components/MainNavbar.vue";
import Footer from "../../Components/Footer.vue";
import ProductList from "../../Components/ProductList.vue";

defineProps({ products: Object });
</script>

<template>
  <MainNavbar />
  <main class="z-20 mt-8">
    <ProductList :products="products" />
  </main>
  <Footer />
</template>
