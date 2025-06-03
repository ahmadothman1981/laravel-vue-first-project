<template>
  <GuestLayout>
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create New Account</h2>

      <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
          <form @submit.prevent="submit" class="space-y-4">
              <div>
                  <label for="name" class="block text-sm/6 font-medium text-gray-900">Full Name</label>
                  <div class="mt-2">
                      <input name="text" id="name" v-model="data.name" 
                          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                      <p v-if="errors.name" class="mt-1 text-sm text-red-600">{{ errors.name[0] }}</p>
                  </div>
              </div>

              <div>
                  <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
                  <div class="mt-2">
                      <input type="email" name="email" v-model="data.email" id="email" autocomplete="email" 
                          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                      <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email[0] }}</p>
                  </div>
              </div>

              <div>
                  <div class="flex items-center justify-between">
                      <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                  </div>
                  <div class="mt-2">
                      <input type="password" name="password" id="password" v-model="data.password" required
                          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                      <p v-if="errors.password" class="mt-1 text-sm text-red-600">{{ errors.password[0] }}</p>
                  </div>
              </div>
              <div>
                  <div class="flex items-center justify-between">
                      <label for="passwordConfirmation" class="block text-sm/6 font-medium text-gray-900">Password Confirmation</label>
                  </div>
                  <div class="mt-2">
                      <input type="password" name="passwordConfirmation" v-model="data.password_confirmation"
                          id="passwordConfirmation" required
                          class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                  </div>
              </div>

              <div>
                  <button type="submit" :disabled="loading"
                      class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:opacity-50 disabled:cursor-not-allowed">
                      <span v-if="!loading">Sign Up</span>
                      <span v-else>Processing...</span>
                  </button>
              </div>
          </form>

          <p class="mt-10 text-center text-sm/6 text-gray-500">
              Already have an account?
              {{ ' ' }}
              <router-link to="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign in here</router-link>
          </p>
      </div>
  </GuestLayout>
</template>

<script>
import GuestLayout from '../components/GuestLayout.vue'
import axiosClient from "../axios.js";
import { ref } from 'vue'
import { useRouter } from 'vue-router'

export default {
  components: {
      GuestLayout
  },
  setup() {
      const router = useRouter();
      const data = ref({
          name: '',
          email: '',
          password: '',
          password_confirmation: ''
      });
      
      const errors = ref({
          name: [],
          email: [],
          password: [],
          password_confirmation: []
      });
      const loading = ref(false);

      const submit = async function () {
          loading.value = true;
          errors.value = {};
          
          try {
              // Get CSRF cookie first
              await axiosClient.get('/sanctum/csrf-cookie');
              
              // Submit registration
              const response = await axiosClient.post("/register", data.value);
              
              // Redirect after successful registration
              router.push('/'); // or wherever you want to redirect
              console.log('Registration successful:', response.data);
          } catch (error) {
              if (error.response && error.response.status === 422) {
                  // Validation errors
                  errors.value = error.response.data.errors;
              } else {
                  // Other errors
                  console.error('Registration failed:', error);
                  alert('Registration failed. Please try again.');
              }
          } finally {
              loading.value = false;
          }
      }

      return {
          data,
          errors,
          loading,
          submit
      }
  }
}
</script>

<style scoped></style>