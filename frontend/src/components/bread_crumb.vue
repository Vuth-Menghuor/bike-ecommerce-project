<template>
  <nav class="breadcrumb">
    <ul>
      <li>
        <router-link to="/">Home</router-link>
      </li>
      <li v-if="brand">
        <router-link :to="`/brands/${brand}`">{{ brand }}</router-link>
      </li>
      <li v-if="product">{{ product }}</li>
    </ul>
  </nav>
</template>

<script setup>
import { defineProps } from 'vue'

// eslint-disable-next-line no-unused-vars
const props = defineProps({
  brand: {
    type: String,
    required: false,
  },
  product: {
    type: String,
    required: false,
  },
})
</script>

<style scoped>
.breadcrumb ul {
  display: flex;
  list-style: none;
  padding: 0;
  gap: 5px;
  font-size: 14px;
}

.breadcrumb li::after {
  content: '>';
  margin: 0 5px;
}

.breadcrumb li:last-child::after {
  content: '';
}

.breadcrumb a {
  color: #696969;
  text-decoration: none;
}

.breadcrumb li {
  font-weight: 400;
  color: #696969;
}
</style>
