<template>
    <Guest-layout>
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create New Account</h2>

<div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
  <form class="space-y-4" action="#" method="POST">
    <div>
      <label for="name" class="block text-sm/6 font-medium text-gray-900">Full Name</label>
      <div class="mt-2">
        <input  name="text" id="name"  required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
      </div>
    </div>

    <div>
      <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
      <div class="mt-2">
        <input type="email" name="email" id="email" autocomplete="email" required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
      </div>
    </div>

    <div>
      <div class="flex items-center justify-between">
        <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
       
      </div>
      <div class="mt-2">
        <input type="password" name="password" id="password"  required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
      </div>
    </div>
    <div>
      <div class="flex items-center justify-between">
        <label for="passwordConfirmation" class="block text-sm/6 font-medium text-gray-900">Password Confirmation</label>
       
      </div>
      <div class="mt-2">
        <input type="password" name="passwordConfirmation" id="passwordConfirmation"  required="" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
      </div>
    </div>

    <div>
      <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
    </div>
  </form>

  <p class="mt-10 text-center text-sm/6 text-gray-500">
   Already have an account?
    {{ ' ' }}
    <router-link to="/login" href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">sign in here</router-link>
  </p>
</div>
    </Guest-layout>
</template>
<script>
import GuestLayout from '../components/GuestLayout.vue'

export default {
  components: {
    GuestLayout
  }
}

</script>
<style scoped></style>