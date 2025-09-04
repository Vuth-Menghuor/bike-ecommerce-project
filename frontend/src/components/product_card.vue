<script setup>
import { Icon } from '@iconify/vue'
import { ref, onMounted, onUnmounted, computed } from 'vue'
import bike1 from '@/assets/images/product_card/mount_1.png'
import bike2 from '@/assets/images/product_card/mount_2.png'
import bike3 from '@/assets/images/product_card/mount_3.png'
import bike4 from '@/assets/images/product_card/road_1.png'
import bike5 from '@/assets/images/product_card/road_2.png'
import bike6 from '@/assets/images/product_card/road_3.png'

const stars = computed(() => Array.from({ length: 5 }, (_, i) => i + 1))

function formatNumber(number) {
  return number.toLocaleString()
}

const bikes = ref([
  {
    id: 1,
    title: 'Bianchi T-Tronik C Type - Sunrace (2023)',
    subtitle: 'Bianchi',
    price: 24400,
    color: 'Pink',
    badge: {
      text: 'Hot',
      icon: 'mdi:hot',
      gradient: 'linear-gradient(135deg, rgb(255, 107, 107), rgb(255, 82, 82))',
    },
    discount: {
      type: 'percent',
      value: 10,
    },
    rating: 4.8,
    reviewCount: 3221,
    specs: [
      {
        text: 'The 2023 Bianchi T-Tronik C-Type Sunrace is a refined Class 1 electric city bike designed for urban commuting and leisure rides. It features a Shimano E6100 250W mid-drive motor delivering 60Nm of torque, paired with a 417Wh Phylion battery offering up to 95 km of range.',
      },
    ],
    image: bike1,
  },
  {
    id: 2,
    title: 'Trek Slash 9.8 XT Carbon',
    subtitle: 'Trek',
    price: 44299,
    color: 'Orange',
    badge: {
      text: 'New',
      icon: 'material-symbols-light:new-releases',
      gradient: 'linear-gradient(135deg, #3491FA, #3491FA)',
    },
    discount: {
      type: 'fixed',
      value: 399,
    },
    rating: 2.4,
    reviewCount: 3221,
    specs: [
      {
        text: 'The Trek Slash 9.8 XT is a high-performance enduro mountain bike designed for aggressive trail riding and technical descents. It features a lightweight OCLV Mountain Carbon frame with 170mm of front and rear travel, utilizing a high-pivot suspension system with an idler pulley to enhance rear-wheel traction and control over rough terrain .',
      },
    ],
    image: bike2,
  },
  {
    id: 3,
    title: 'Santa Cruz Hightower CC X01',
    subtitle: 'Specialized',
    price: 29999,
    color: 'Grey',
    badge: {},
    discount: null,
    rating: 5,
    reviewCount: 3221,
    specs: [
      {
        text: "The Santa Cruz Hightower CC X01 is a versatile trail bike designed to excel on both climbs and descents. Featuring 150mm front and 140mm rear travel, it incorporates Santa Cruz's lower-link VPP suspension design, providing a nearly linear leverage curve for efficient pedaling and excellent bump absorption.",
      },
    ],
    image: bike3,
  },
  {
    id: 4,
    title: 'Giant TCR Advanced Pro 1',
    subtitle: 'Giant',
    price: 3799,
    badge: {},
    discount: {
      type: 'percent',
      value: 30,
    },
    rating: 4.8,
    reviewCount: 1120,
    specs: [
      {
        text: 'Carbon fiber frame, lightweight and aerodynamic. Perfect for racing and long-distance rides on smooth roads.',
      },
    ],
    image: bike4,
  },
  {
    id: 5,
    title: 'Specialized Allez Sprint Comp',
    subtitle: 'Specialized',
    price: 3299,
    badge: {},
    discount: {
      type: 'fixed',
      value: 97,
    },
    rating: 4.7,
    reviewCount: 890,
    specs: [
      {
        text: 'High-modulus carbon fork, lightweight alloy frame. Optimized for sprinting and fast-paced group rides.',
      },
    ],
    image: bike5,
  },
  {
    id: 6,
    title: 'Cannondale Synapse Carbon Disc Ultegra',
    subtitle: 'Cannondale',
    price: 4199,
    badge: {
      text: 'New',
      icon: 'material-symbols-light:new-releases',
      gradient: 'linear-gradient(135deg, #3491FA, #3491FA)',
    },
    discount: null,
    rating: 3.5,
    reviewCount: 650,
    specs: [
      {
        text: 'Comfort-oriented carbon frame with disc brakes. Designed for long endurance rides with smooth handling and stability.',
      },
    ],
    image: bike6,
  },
])

const favorites = ref(new Set())
const visibleBikes = ref(new Set())

const toggleFavorite = (bikeId) => {
  if (favorites.value.has(bikeId)) {
    favorites.value.delete(bikeId)
  } else {
    favorites.value.add(bikeId)
  }
  favorites.value = new Set(favorites.value)
}

const isFavorited = (bikeId) => {
  return favorites.value.has(bikeId)
}

const getDiscountLabel = (bike) => {
  if (!bike.discount) return null
  return bike.discount.type === 'percent'
    ? `${bike.discount.value}% OFF`
    : `-$${bike.discount.value.toLocaleString()} OFF`
}

const getDiscountedPrice = (bike) => {
  if (!bike.discount) return bike.price
  if (bike.discount.type === 'percent') {
    return bike.price - (bike.price * bike.discount.value) / 100
  } else {
    return bike.price - bike.discount.value
  }
}

let observer

onMounted(() => {
  observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        const id = Number(entry.target.dataset.id)
        if (entry.isIntersecting) {
          visibleBikes.value.add(id)
        } else {
          visibleBikes.value.delete(id)
        }
        visibleBikes.value = new Set(visibleBikes.value)
      })
    },
    { threshold: 0.5 },
  )

  const cards = document.querySelectorAll('.product-card')
  cards.forEach((card) => observer.observe(card))
})

onUnmounted(() => {
  if (observer) observer.disconnect()
})
</script>

<template>
  <div class="bikes-container">
    <div v-for="bike in bikes" :key="bike.id" class="product-card" :data-id="bike.id">
      <div class="card-header">
        <div class="sale-badge" :style="{ background: bike.badge.gradient }">
          <Icon :icon="bike.badge.icon" class="sale-icon" />
          <span>{{ bike.badge.text }}</span>
        </div>
        <button
          class="favorite-btn"
          :class="{ favorited: isFavorited(bike.id) }"
          @click="toggleFavorite(bike.id)"
        >
          <Icon
            :icon="isFavorited(bike.id) ? 'solar:heart-bold' : 'solar:heart-linear'"
            class="fav-icon"
          />
        </button>
      </div>

      <div class="product-image-container">
        <div v-if="bike.discount" class="promotion-price">
          <span>{{ getDiscountLabel(bike) }}</span>
        </div>
        <!-- <img
          :src="bike.image"
          alt="bikes-image-transparent"
          class="product-image"
          :class="{
            'slide-in': visibleBikes.has(bike.id),
            'slide-out': !visibleBikes.has(bike.id),
          }"
        /> -->
        <img :src="bike.image" alt="bikes-image-transparent" class="product-image" />
      </div>

      <div class="price-info">
        <label class="product-price discounted"
          >${{ formatNumber(getDiscountedPrice(bike)) }}</label
        >
        <span v-if="bike.discount" class="original-price">${{ formatNumber(bike.price) }}</span>
      </div>

      <div class="product-info">
        <label class="product-title">{{ bike.title }}<br /></label>
        <div class="subtitle-color">
          <span class="product-subtitle">{{ bike.subtitle }}</span>
          <span class="separator">|</span>
          <span class="product-color">Color {{ bike.color }}</span>
        </div>
      </div>

      <div class="rating-section">
        <div class="stars">
          <span
            v-for="star in stars"
            :key="star"
            class="star"
            :class="{ filled: star <= Math.floor(bike.rating) }"
          >
            <Icon icon="line-md:star-filled" />
          </span>
        </div>
        <span class="rating-text"> ({{ bike.rating }}) {{ formatNumber(bike.reviewCount) }} </span>
      </div>

      <div class="product-specs">
        <div v-for="spec in bike.specs" :key="spec.label" class="spec-item">
          <div class="spec-content">
            <span class="spec-text">{{ spec.text }}</span>
          </div>
        </div>
      </div>

      <div class="card-footer">
        <button class="view-detail-btn">
          <span class="detail" :style="{ background: bike.bgPrice }">View Details</span>
        </button>
        <button class="quick-buy-btn" :style="{ background: bike.bgBtn }">
          <Icon icon="fa7-solid:cart-arrow-down" />
          <span>Add To Cart</span>
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>
.subtitle-color {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 14px;
  color: grey;
  font-weight: 400;
}

.separator {
  color: grey;
}

.product-color {
  font-weight: 500;
}

.product-price.discounted {
  font-size: 20px;
  font-weight: 600;
  color: red;
}
.original-price {
  font-size: 14px;
  color: #999;
  text-decoration: line-through;
  margin-left: 8px;
}
.rating-section {
  display: flex;
  align-items: start;
  gap: 6px;
  padding: 10px 24px 10px 24px;
}

.stars {
  display: flex;
}

.star {
  color: #d1d5db;
  font-size: 16px;
}

.star.filled {
  color: #fbbf24;
}

.rating-text {
  font-size: 12px;
  color: #6b7280;
  font-family: 'Poppins', sans-serif;
}

.product-specs {
  display: flex;
  font-family: 'Poppins', sans-serif;
  padding: 10px 20px;
  gap: 16px;
  position: relative;
  width: 400px;
  overflow: hidden;
  text-overflow: ellipsis;
  z-index: 3;
}

.spec-item {
  flex: 1;
  display: block;
  min-width: 0;
}

.spec-text {
  line-height: 1.6;
  margin: 0;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
  font-size: 12px;
  color: grey;
  font-weight: 500;
}

.bikes-container {
  display: flex;
  gap: 34px;
  flex-wrap: wrap;
  justify-content: center;
  padding: 20px;
}

/* .product-card:hover .product-image.slide-in {
  transform: scale(1.05) rotate(2deg);
} */

.sale-icon {
  font-size: 22px;
}

.promotion-price {
  position: absolute;
  bottom: 0px;
  right: -1px;
  color: white;
  background-color: orange;
  font-family: 'Poppins', sans-serif;
  padding: 6px 12px 6px 14px;
  display: flex;
  align-items: center;
  clip-path: polygon(5% 0, 100% 0, 100% 20%, 100% 80%, 100% 99%, 5% 100%, 0 85%, 0 15%);
  gap: 4px;
  z-index: 10;
}

.promotion-price span {
  font-family: 'Poppins', sans-serif;
  font-size: 12px;
  font-weight: 600;
}

.sale-badge span {
  font-size: 12px;
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
}

.sale-badge {
  position: relative;
  left: -26px;
  color: white;
  padding: 6px 12px 6px 14px;
  display: flex;
  align-items: center;
  clip-path: polygon(0 0, 95% 0, 100% 20%, 100% 80%, 95% 100%, 0 100%, 0% 80%, 0% 20%);
  gap: 4px;
}

.product-card {
  max-width: 520px;
  background-color: white;
  border: 1px solid #dee2e6;
  border-radius: 10px;
  object-fit: contain;
  overflow: hidden;
  position: relative;
}

.card-header {
  position: absolute;
  top: 16px;
  left: 20px;
  right: 16px;
  display: flex;
  justify-content: space-between; /* push badge left, heart right */
  align-items: center;
  z-index: 5;
}

.product-info {
  flex: 1;
  font-family: 'Poppins', sans-serif;
  line-height: 1.6;
  padding: 10px 24px 0 24px;
}

.price-info {
  flex: 1;
  font-family: 'Poppins', sans-serif;
  padding: 12px 24px 0 24px;
}

.favorite-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid #dee2e6;
  cursor: pointer;
  padding: 6px;
  border-radius: 50%;
  color: grey;
  background-color: white;
  transition: all 0.3s ease;
}

.favorite-btn.favorited {
  background-color: #ffebef;
  border-color: #ff4d6d;
  color: #ff4d6d;
}

.favorite-btn.favorited .fav-icon {
  color: #ff4d6d;
}

.product-price {
  font-size: 20px;
  font-weight: 600;
  color: #333;
}

.product-title {
  font-size: 16px;
  font-weight: 600;
  color: #333;
  margin: 0 0 4px 0;
}

.product-subtitle {
  font-size: 14px;
  color: grey;
  font-weight: 400;
  margin: 0;
}

.fav-icon {
  font-size: 20px;
}

.product-image {
  width: 100%; /* always take full width of card */
  height: 100%; /* stretch to container height */
  max-height: unset; /* remove fixed height limit */
  object-fit: cover; /* fill area while keeping ratio (may crop) */
  z-index: 2;
  position: relative;
  /* opacity: 0; */
  /* transform: translateY(50px);
  transition:
    transform 0.6s ease,
    opacity 0.6s ease; */
  opacity: 1; /* always visible */
  transform: none; /* no translation */
  transition: none; /* remove animation */
}

.product-image-container {
  position: relative;
  width: 100%;
  height: 250px; /* set a fixed height for consistency */
  overflow: hidden; /* crop overflow */
  display: flex;
  align-items: center;
  justify-content: center;
}

.product-image.slide-in {
  opacity: 1;
  transform: translateY(0);
}

.product-image.slide-out {
  opacity: 0;
  transform: translateY(50px);
}

.card-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 20px;
  gap: 16px;
}

.view-detail-btn {
  display: flex;
  align-items: center;
  z-index: 4;
  border: 1px solid #b8b8b8;
  color: black;
  background-color: white;
}

.detail {
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-weight: 500;
  /* clip-path: polygon(5% 0, 95% 0, 100% 20%, 100% 80%, 95% 100%, 5% 100%, 0 80%, 0 20%); */
  padding: 10px 50px;
}

.quick-buy-btn {
  display: flex;
  align-items: center;
  gap: 8px;
  font-family: 'Poppins', sans-serif;
  border: 1px solid #14c9c9;
  background: #e8fffb;
  color: #07828b;
  padding: 10px 50px;
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  /* clip-path: polygon(5% 0, 95% 0, 100% 20%, 100% 80%, 95% 100%, 5% 100%, 0 80%, 0 20%); */
  transition: background-color 0.3s ease;
  flex-shrink: 0;
}
</style>
