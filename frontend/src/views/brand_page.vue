<script setup>
defineProps({
  id: String,
})
</script>

<template>
  <div class="brand-page">
    <h1>Brand: {{ id }}</h1>
    <p>Here you can load products or details about {{ id }}.</p>
  </div>
</template>
