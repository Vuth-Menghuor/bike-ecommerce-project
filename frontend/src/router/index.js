import { createRouter, createWebHistory } from 'vue-router'
import Authentication_page from '@/views/authentication_page.vue'
import Home_view from '@/views/home_view.vue'
import Brand_page from '@/views/brand_page.vue'
import Bike_detail from '@/views/bike_detail.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home_view,
  },
  {
    path: '/authentication/:type',
    name: 'Authentication',
    component: Authentication_page,
    props: true,
  },
  {
    path: '/brands/:id',
    name: 'BrandPage',
    component: Brand_page,
    props: true,
  },
  {
    path: '/bike/:id',
    name: 'BikeDetail',
    component: Bike_detail,
    props: true,
  },
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
})

export default router
