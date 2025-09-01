// Handles how a single brand looks (logo, hover effects, padding, etc.).
<script setup>
defineProps({
  brand: Object,
})
</script>

<template>
  <RouterLink :to="`/brands/${brand.id}`" class="brand-card">
    <img :src="brand.logo" :alt="brand.name" class="brand-card__logo" />
  </RouterLink>
</template>

<style scoped>
.brand-card {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 230px;
  padding: 30px;
  height: 50px;
  border: 1px solid #dee2e6;
  margin: 0 6px;
  flex-shrink: 0;
}

.brand-card__logo {
  max-width: 100%;
  height: auto;
}
</style>
