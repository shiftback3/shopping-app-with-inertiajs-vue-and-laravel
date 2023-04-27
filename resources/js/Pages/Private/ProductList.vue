<script setup>
import DashBoardNavbar from "../../Components/DashBoardNavbar.vue";
import Footer from "../../Components/Footer.vue";
import ProductList from "../../Components/ProductTable.vue";

defineProps({
  user: Object,
  products: Object,
});
</script>

<template>
  <DashBoardNavbar :user="user" />
  <main class="z-20 mt-8">
    <ProductList :products="products" />
  </main>
  <Footer />
</template>
