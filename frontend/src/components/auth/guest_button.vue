<template>
  <router-link to="/">
    <button class="guest-button">Continue as Guest</button>
  </router-link>
</template>

<style scoped>
.guest-button {
  padding: 10px 20px;
  color: black;
  background-color: white;
  border-radius: 6px;
  border: 1px solid rgb(179, 179, 179);
  cursor: pointer;
  font-weight: 500;
  height: 50px;
  font-size: 14px;
  transition: background-color 0.3s ease;
  font-family: 'Poppins', sans-serif;
}
</style>
