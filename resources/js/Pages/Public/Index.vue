<script setup>
import MainNavbar from "../../Components/MainNavbar.vue";
import Footer from "../../Components/Footer.vue";
import ProductList from "../../Components/ProductList.vue";

defineProps({ name: String });
</script>

<template>
  <MainNavbar />
  <main class="z-20 mt-8">
    <ProductList />
  </main>
  <Footer />
</template>
