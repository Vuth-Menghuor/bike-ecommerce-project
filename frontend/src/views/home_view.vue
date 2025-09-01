<script>
import Brand_carousel from '@/components/brand/brand_carousel.vue'
import Landing_page from '@/components/landing_page.vue'
import Navigation_header from '@/components/navigation_header.vue'

export default {
  name: 'HomeView',
  props: ['type'],
  components: {
    Navigation_header,
    Landing_page,
    Brand_carousel,
  },
}
</script>

<template>
  <div>
    <Navigation_header />
    <Landing_page />
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
