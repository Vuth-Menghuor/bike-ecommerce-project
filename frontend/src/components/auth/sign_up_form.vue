<script setup lang="ts">
import { Icon } from '@iconify/vue'
import Guest_button from './guest_button.vue'
</script>

<template>
  <div class="auth-container">
    <div class="auth-card">
      <!-- Header -->
      <div class="auth-header">
        <h1 class="auth-title">Sign Up</h1>
        <div class="auth-prompt">
          <span>Already have an account?</span>
          <router-link to="/authentication/sign_in">Sign In</router-link>
        </div>
      </div>
      <!-- Form Section -->
      <form action="auth-form">
        <div class="form-group">
          <input type="text" placeholder="Username" class="input-text" />
          <Icon icon="mdi:user" class="input-icon" />
        </div>
        <div class="form-group">
          <input type="text" placeholder="Email" class="input-text" />
          <Icon icon="ic:baseline-email" class="input-icon" />
        </div>
        <div class="form-group">
          <input type="password" placeholder="Password" class="input-text" />
          <Icon icon="mdi:password" class="input-icon" />
        </div>
      </form>
      <!-- Form Option -->
      <div class="form-option">
        <div class="checkbox-wrapper">
          <input type="checkbox" id="remember" class="form-checkbox" />
          <label class="checkbox-label" for="remember">I agree to the</label>
        </div>
        <a href="#" class="link">Terms & Conditions</a>
      </div>
      <!-- Submit Button -->
      <div class="button-wrapper">
        <button type="submit" class="submit-button">Sign Up</button>
        <Guest_button />
      </div>
      <!-- Divider -->
      <div class="form-divider">
        <span class="divider-text">or sign up</span>
      </div>
      <!-- Social Section -->
      <div class="social-login">
        <button type="button" class="social-button">
          <Icon icon="flat-color-icons:google" class="social-icon" />
          <span class="social-text">Google</span>
        </button>

        <button type="button" class="social-button">
          <Icon icon="logos:facebook" class="social-icon" />
          <span class="social-text">Facebook</span>
        </button>
      </div>
    </div>
  </div>
</template>

<style scoped>
.social-icon {
  height: 22px;
  width: 22px;
}
.social-button {
  display: flex;
  justify-content: center;
  background-color: transparent;
  height: 40px;
  border: 1px solid rgb(212, 212, 212);
  border-radius: 6px;
  width: 185px;
  align-items: center;
  gap: 12px;
  font-size: 14px;
  font-family: 'Poppins', sans-serif;
}
.social-login {
  display: flex;
  justify-content: space-around;
  margin: 40px 100px;
}
.form-divider {
  position: relative;
  text-align: center;
  margin: 25px 0;
}

.form-divider::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 1px;
  margin: 0 106px 0 82px;
  background: #ddd;
}

.divider-text {
  background: white;
  padding: 0 15px;
  color: #666;
  font-size: 14px;
  position: relative;
  font-weight: 300;
  z-index: 1;
  font-family: 'Poppins', sans-serif;
}
.button-wrapper {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 12px;
  margin-top: 40px;
}
.submit-button {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 440px;
  margin-right: 20px;
  padding: 12px 0;
  font-weight: 500;

  border: none;
  background-color: #14c9c9;
  color: white;
  font-size: 16px;
  border-radius: 6px;
  cursor: pointer;
}

.form-checkbox {
  height: 14px;
  width: 14px;
}
.form-option {
  display: flex;
  justify-content: start;
  align-items: center;
  gap: 4px;
  margin-top: 12px;
  margin-left: 84px;
  margin-right: 110px;
  font-family: 'Poppins', sans-serif;
}
.link {
  font-size: 12px;
  font-weight: 500;
}
.checkbox-wrapper {
  display: flex;
  align-items: center;
  gap: 6px;
}
.checkbox-label {
  font-size: 13px;
  font-weight: 300;
}
.auth-prompt span {
  padding-right: 6px;
}
.auth-prompt {
  font-size: 14px;
}
.form-group {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 35px;
}
.input-text {
  font-size: 14px;
  font-family: 'Poppins', sans-serif;
  border: none;
  border-bottom: 1px solid grey;
  padding-right: 30px;
  padding-top: 10px;
  padding-bottom: 10px;
  width: 400px;
  background-color: transparent;
}
.input-text:focus {
  outline: none;
  background-color: transparent;
}
.input-icon {
  position: relative;
  right: 20px;
  height: 20px;
  width: 20px;
  opacity: 70%;
}
.auth-title {
  font-family: 'Poppins', sans-serif;
  font-weight: 400;
  font-size: 40px;
  padding: 0;
  margin: 40px 0 8px 0;
}
.auth-header {
  display: flex;
  justify-content: center;
  flex-direction: column;
  align-items: center;
  font-family: 'Poppins', sans-serif;
}
.auth-card {
  border: 1px solid rgb(202, 202, 202);
  border-radius: 20px;
  background-color: white;
  height: auto;
  width: 630px;
}
</style>
