<script setup lang="ts">
import { Icon } from '@iconify/vue'
import { onMounted, onUnmounted, ref } from 'vue'

// slideshow state
const currentSlide = ref(0)
let slideInterval: NodeJS.Timeout | null = null

import banner1 from '@/assets/images/banner_1.png'
import banner2 from '@/assets/images/banner_2.png'
import banner3 from '@/assets/images/banner_3.png'
import banner4 from '@/assets/images/banner_4.png'
import banner5 from '@/assets/images/banner_5.png'

// import banner5 from '@/assets/images/banner_5.png'

const backgroundImages = [banner1, banner2, banner3, banner4, banner5]

//slide content data
const slideContent = [
  {
    title: '2022 Specialized Turbo Levo Expert Carbon',
    subtitle:
      'High-performance full-suspension electric mountain bike with lightweight carbon frame, advanced motor system, and trail-optimized geometry for tackling climbs, descents, and technical terrain with ease.',
    description: 'A premium e-MTB built for power, range, and confidence on any trail.',
  },
  {
    title: 'Specialized Stumpjumper 15 Comp Alloy',
    subtitle:
      'Alloy full-suspension trail bike with progressive geometry, advanced suspension design, and reliable components built to deliver efficiency, control, and confidence on climbs, descents, and technical singletrack.',
    description: 'A versatile trail bike engineered for balanced performance and durability.',
  },
  {
    title: 'Specialized Levo Comp Alloy G3',
    subtitle:
      'Durable full-suspension electric mountain bike with an alloy frame, powerful motor, long-range battery, and modern trail geometry designed to deliver balance, control, and versatility on technical terrain.',
    description: 'A rugged e-MTB built for performance and all-day trail adventures.',
  },
  {
    title: 'Specialized S-Works Epic World Cup Frameset',
    subtitle:
      'Ultra-lightweight carbon cross-country race frameset engineered with advanced suspension design, progressive geometry, and race-proven stiffness-to-weight ratio for uncompromising speed and efficiency on the world’s toughest XC courses.',
    description: 'A top-tier XC frameset built for pure speed and precision.',
  },
  {
    title: 'Specialized S-Works Levo SL carbon',
    subtitle:
      'Lightweight full-suspension electric trail bike with a premium carbon frame, advanced motor assist, and agile geometry designed to deliver a natural ride feel, exceptional handling, and confidence across diverse terrain.',
    description: 'A high-end e-MTB built for speed, agility, and all-day trail performance.',
  },
]

// auto slideshow function
const startSlideshow = () => {
  slideInterval = setInterval(() => {
    nextSlide()
  }, 4000) // change slide every 4 seconds
}

const stopSlideshow = () => {
  if (slideInterval) {
    clearInterval(slideInterval)
    slideInterval = null
  }
}

const nextSlide = () => {
  currentSlide.value = (currentSlide.value + 1) % backgroundImages.length
}

const prevSlide = () => {
  currentSlide.value =
    currentSlide.value === 0 ? backgroundImages.length - 1 : currentSlide.value - 1
}

const goToSlide = (index: number) => {
  currentSlide.value = index

  // restart the slide show timer
  stopSlideshow()
  startSlideshow()

  //lifecycle hook
}
onMounted(() => {
  startSlideshow()
})

onUnmounted(() => {
  stopSlideshow()
})
</script>

<template>
  <header class="header-slideshow">
    <!-- background slidesshow -->
    <div class="slideshow-container">
      <div
        v-for="(image, index) in backgroundImages"
        :key="index"
        class="slide"
        :class="{ active: index === currentSlide }"
        :style="{ backgroundImage: `url(${image})` }"
      ></div>
    </div>
    <nav class="main-navigation">
      <div class="nav-container">
        <!-- Logo & Menu -->
        <div class="brand-logo-wrapper">
          <Icon icon="ic:outline-menu" class="menu-icon" />
          <div class="brand-logo">
            <!-- <img src="@/assets/images/black_logo.png" alt="Motion Cycle" class="logo-image" /> -->
            <span class="brand-text">MOTION CYCLE</span>
          </div>
        </div>

        <!-- Search Bar -->
        <div class="search-container">
          <input type="search" placeholder="Search Bicycle" class="search-input" />
          <button class="search-button">
            <Icon icon="ri:search-line" class="search-icon" />
          </button>
        </div>

        <!-- Shopping Cart -->
        <div class="cart-container">
          <button class="cart-button">
            <Icon icon="ion:cart" class="cart-icon" />
            <span class="cart-badge">3</span>
          </button>
          <div class="account-container">
            <router-link to="/authentication/sign_in">
              <button class="user-account">
                <Icon icon="mdi:user" class="account-icon" />
              </button>
            </router-link>
          </div>
        </div>
      </div>
    </nav>

    <!-- Brand Categories Navigation - Moved outside nav-container -->
    <nav class="brand-navigation">
      <div class="brand-nav-container">
        <ul class="brand-list">
          <li class="brand-item">
            <a href="/cannondale" class="brand-link">Cannondale</a>
          </li>
          <li class="brand-item">
            <a href="/trek" class="brand-link">Trek</a>
          </li>
          <li class="brand-item">
            <a href="/bianchi" class="brand-link">Bianchi</a>
          </li>
          <li class="brand-item">
            <a href="/giant" class="brand-link">Giant</a>
          </li>
          <li class="brand-item">
            <a href="/cervelo" class="brand-link">Cervélo</a>
          </li>
          <li class="brand-item">
            <a href="/colnago" class="brand-link">Colnago</a>
          </li>
          <li class="brand-item">
            <a href="/haro-bikes" class="brand-link">Haro Bikes</a>
          </li>
          <li class="brand-item">
            <a href="/shimano" class="brand-link">Shimano</a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- title pagination navigation -->
    <section class="hero-section">
      <div class="hero-content">
        <div class="hero-text">
          <h1 class="hero-title">{{ slideContent[currentSlide].title }}</h1>
          <p class="hero-subtitle">
            {{ slideContent[currentSlide].subtitle }}
          </p>
        </div>
        <!-- Pagination Navigation -->
        <div class="pagination-content">
          <div class="pagination-nav">
            <div class="pagination-dots">
              <span
                v-for="(dot, index) in backgroundImages"
                :key="index"
                class="dot"
                :class="{ active: index === currentSlide }"
                @click="goToSlide(index)"
              >
              </span>
            </div>
            <div class="pagination-arrows">
              <button class="arrow-btn prev" @click="prevSlide">
                <Icon icon="material-symbols:arrow-back" class="arrow-icon" />
              </button>
              <button class="arrow-btn next" @click="nextSlide">
                <Icon icon="material-symbols:arrow-forward" class="arrow-icon" />
              </button>
            </div>
          </div>
          <span class="pagination-text">{{ slideContent[currentSlide].description }} </span>
        </div>
      </div>
    </section>
  </header>
</template>

<style scoped>
.account-container {
  display: flex;
  align-items: center;
  justify-content: center;
}

.user-account {
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.3);
  /* border-radius: 50%; */
  width: 42px;
  height: 42px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: white;
}

.account-icon {
  font-size: 22px;
}

.header-slideshow {
  position: relative;
  width: 100%;
  height: 100vh;
  overflow: hidden;
  color: white;
}
.slideshow-container {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
}
.slide {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  opacity: 0;
  transition: opacity 1s ease-in-out;
}
.slide.active {
  opacity: 1;
}

/* Add a subtle overlay for better text readability */
.header-slideshow::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.3);
  z-index: 0;
}

/* Ensure content is above overlay */
.main-navigation,
.brand-navigation,
.hero-section {
  position: relative;
  z-index: 1;
}
.pagination-text {
  font-size: 12px;
  font-family: 'Poppins', sans-serif;
  padding-top: 16px;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 460px;
  display: block;
  transition: opacity 0.5s ease;
}

.pagination-content {
  display: flex;
  flex-direction: column;
  align-items: center;
}
.hero-text {
  width: 44vw;
}
.hero-content {
  display: flex;
  align-items: end;
  justify-content: space-between;
  margin: 0 80px;
  height: 80vh;
}

.hero-title {
  font-size: 2rem;
  font-weight: 600;
  margin-bottom: 1rem;
  line-height: 1.2;
  font-family: 'Poppins', sans-serif;
  width: 28rem;
  transition: opacity 0.5s ease;
}

.hero-subtitle {
  font-size: 14px;
  opacity: 0.9;
  line-height: 2;
  font-weight: 300;
  width: 36rem;
  font-family: 'Poppins', sans-serif;
  transition: opacity 0.5s ease;
}

/* Pagination Navigation Styles */
.pagination-nav {
  display: flex;
  align-items: center;
  gap: 1.5rem;
  justify-content: flex-end;
}

.pagination-dots {
  display: flex;
  gap: 0.5rem;
  align-items: center;
  justify-content: flex-end;
}

.dot {
  width: 50px;
  height: 4px;
  background: rgba(255, 255, 255, 0.3);
  cursor: pointer;
  transition: all 0.3s ease;
}

.dot.active {
  background: white;
  width: 50px;
  height: 4px;
  transform: scaleY(1.5);
}

.dot:hover:not(.active) {
  background: rgba(255, 255, 255, 0.5);
  transform: scaleY(1.2);
}

.pagination-arrows {
  display: flex;
  gap: 1rem;
}

.arrow-btn {
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  color: white;
}

.arrow-btn:hover {
  background: rgba(255, 255, 255, 0.2);
  border-color: rgba(255, 255, 255, 0.5);
  transform: translateY(-1px) scale(1.05);
}

.arrow-btn:active {
  transform: translateY(0) scale(0.95);
}

.arrow-icon {
  font-size: 18px;
}

.brand-navigation {
  background: rgba(0, 0, 0, 0.15);
  border-bottom: 1px solid #b9b1b1;
  border-top: 1px solid #b9b1b1;
  backdrop-filter: blur(5px);
}

.brand-nav-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
}

.brand-list {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
  gap: 0;
}

.brand-item {
  flex: 1;
}

.brand-link {
  display: block;
  padding: 1rem 1.5rem;
  color: white;
  text-decoration: none;
  text-align: center;
  font-weight: 400;
  transition: all 0.3s ease;
  font-size: 14px;
  font-family: 'Poppins', sans-serif;
  border-bottom: 2px solid transparent;
}

.brand-link:hover {
  background: rgba(255, 255, 255, 0.1);
  border-bottom-color: #b9b1b1;
  transform: translateY(-1px);
}

.main-navigation {
  background-color: transparent;
  backdrop-filter: blur(5px);
}

.nav-container {
  display: flex;
  align-items: center;
  justify-content: space-around;
  padding: 1rem 2rem;
  gap: 1rem;
  flex-wrap: wrap;
}

.brand-logo-wrapper {
  display: flex;
  align-items: center;
  gap: 2rem;
}

.menu-icon {
  font-size: 36px;
  cursor: pointer;
  transition: transform 0.3s ease;
}

.menu-icon:hover {
  transform: scale(1.1);
}

.brand-logo {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.logo-image {
  width: 45px;
  height: auto;
}

.brand-text {
  font-family: 'Poppins', sans-serif;
  font-weight: 600;
  font-size: 20px;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

.search-container {
  flex: 1 1 500px;
  min-width: 200px;
  max-width: 600px;
  position: relative;
}

.search-input {
  width: 100%;
  height: 36px;
  padding: 0.5rem 1rem;
  padding-right: 3rem;
  border-radius: 25px;
  border: 1px solid rgba(255, 255, 255, 0.3);
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  margin-right: 100px;
  outline: none;
  transition: all 0.3s ease;
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
}

.search-input:focus {
  border-color: rgba(255, 255, 255, 0.6);
  background: rgba(255, 255, 255, 0.95);
  box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.2);
}

.search-button {
  position: absolute;
  top: 50%;
  right: 0.5rem;
  transform: translateY(-50%);
  background: none;
  border: none;
  cursor: pointer;
  color: #666;
  transition: color 0.3s ease;
}

.search-button:hover {
  color: #333;
}

.search-icon {
  font-size: 18px;
}

.cart-container {
  position: relative;
  margin-left: 0.5rem;
  display: flex;
  align-items: center;
  gap: 2rem;
}

.cart-button {
  background: none;
  border: none;
  cursor: pointer;
  position: relative;
  padding-top: 0.5rem;
  transition: transform 0.3s ease;
}

.cart-icon {
  width: 30px;
  height: auto;
  color: white;
}

.cart-badge {
  position: absolute;
  top: -6px;
  right: -6px;
  background: #ef4444;
  color: white;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.75rem;
  font-weight: 600;
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
  }
}
</style>
