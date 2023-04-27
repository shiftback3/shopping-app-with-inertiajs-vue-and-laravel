<script setup>
import DashBoardNavbar from "../../Components/DashBoardNavbar.vue";
import Footer from "../../Components/Footer.vue";
import ProductList from "../../Components/ProductList.vue";

defineProps({ user: Object });
</script>

<template>
  <DashBoardNavbar :user="user" />
  <main class="z-20 mt-8">
    <ProductList />
  </main>
  <Footer />
</template>
