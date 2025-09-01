<script>
import Navigation_bar from '@/components/layout/navigation_bar.vue'

export default {
  name: 'HomeView',
  props: ['type'],
  components: {
    Navigation_bar,
  },
}
</script>

<template>
  <div>
    <Navigation_bar />
  </div>
</template>
