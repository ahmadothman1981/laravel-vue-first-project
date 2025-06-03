<template>
    <Guest-layout>
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Sign in to your account</h2>

<div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
  <form @submit.prevent="submit" class="space-y-6">
    <div>
      <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
      <div class="mt-2">
        <input type="email" v-model="data.email" name="email" id="email" autocomplete="email" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
      </div>
    </div>

    <div>
      <div class="flex items-center justify-between">
        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
        <div class="text-sm">
          <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
        </div>
      </div>
      <div class="mt-2">
        <input type="password" v-model="data.password" name="password" id="password" autocomplete="current-password" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
      </div>
    </div>

    <div class="mt-10">
      <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
    </div>
  </form>

  <p class="mt-10 text-center text-sm/6 text-gray-500">
    Not a member?
    {{ ' ' }}
    <RouterLink to="/signup" class="font-semibold text-indigo-600 hover:text-indigo-500">Sign Up</RouterLink>
  </p>
</div>
    </Guest-layout>
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
          
          email: '',
          password: '',
          
      });
      
      const errors = ref({});
      const loading = ref(false);

      const submit = async function () {
          loading.value = true;
          errors.value = {};
          
          try {
              // Get CSRF cookie first
              await axiosClient.get('/sanctum/csrf-cookie');
              
              // Submit sign in
              const response = await axiosClient.post("/login", data.value);
              
              // Redirect after successful login
              router.push('/'); // or wherever you want to redirect
              console.log('Login successful:', response.data);
          } catch (error) {
              if (error.response && error.response.status === 422) {
                  // Validation errors
                  errors.value = error.response.data.errors;
              } else {
                  // Other errors
                  console.error('Login failed:', error);
                  alert('Login failed. Please try again.');
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