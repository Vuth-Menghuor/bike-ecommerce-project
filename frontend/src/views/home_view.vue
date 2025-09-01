<script>
import Brand_carousel from '@/components/brand/brand_carousel.vue'
import Navigation_bar from '@/components/layout/navigation_bar.vue'

export default {
  name: 'HomeView',
  props: ['type'],
  components: {
    Navigation_bar,
    Brand_carousel,
  },
}
</script>

<template>
  <div>
    <Navigation_bar />
    <div>
      <label class="brand-list-title">Brand Lists</label>
      <Brand_carousel />
    </div>
  </div>
</template>

<style scoped>
.brand-list-title {
  margin: 50px 0;
  display: flex;
  justify-content: center;
  font-family: 'Poppins', sans-serif;
  font-size: 1.8rem;
}
</style>
