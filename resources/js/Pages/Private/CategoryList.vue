<script setup>
import DashBoardNavbar from "../../Components/DashBoardNavbar.vue";
import Footer from "../../Components/Footer.vue";
import CategoryList from "../../Components/CategoryTable.vue";

defineProps({
  user: Object,
  categories: Object,
});
</script>

<template>
  <DashBoardNavbar :user="user" />
  <main class="z-20 mt-8">
    <CategoryList :categories="categories" />
  </main>
  <Footer />
</template>
