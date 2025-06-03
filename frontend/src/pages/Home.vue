<template>
  <div>
    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Upload Image</h1>
      </div>
    </header>
    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <p v-if="errors.path" class="mt-1 text-sm text-red-600">
  {{ errors.path[0] }}
</p>
        <form @submit.prevent="submit">
        <div class="col-span-full">
            <label for="image" class="block text-sm/6 font-medium text-red-900">Image</label>
            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
              <div class="text-center">
                <PhotoIcon class="mx-auto size-12 text-gray-300" aria-hidden="true" />
                <div class="mt-4 flex text-sm/6 text-gray-600">
                  <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 focus-within:outline-hidden hover:text-indigo-500">
                    <span>Upload a file</span>
                    <input @change="handleImageUpload"  id="file-upload" name="file-upload" type="file" class="sr-only" />
                  </label>
                  <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
              </div>
            </div>
            <div class="mb-4">
            <label for="label" class="block text-sm/6 font-medium text-red-900">Label</label>
            <div class="mt-2">
              <input type="text" v-model="data.label" name="label" id="label"  class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
            </div>
            <button type="submit" class="rounded-sm bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Upload</button>

          </div>
          </div>
        </form>
      </div>
    </main>
    
      </div>
    
</template>
<script setup>
import { PhotoIcon } from '@heroicons/vue/24/solid';
import { ref } from 'vue';
import axiosClient from '../axios';
import { useRouter } from 'vue-router';
import { useUserStore } from '@/store/user';

const router = useRouter();
const userStore = useUserStore();

const data = ref({
  label: '',
  path: null,
});

const errors = ref({}); // ✅ This fixes the ReferenceError

function handleImageUpload(event) {
  const file = event.target.files[0];
  data.value.path = file || null;
}

async function submit() {
  const formData = new FormData();
  formData.append('label', data.value.label);
  formData.append('path', data.value.path); // ✅ Must be a valid image file

  try {
    await axiosClient.post('/api/images', formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    });
    router.push({ name: 'MyImages' });
  } catch (err) {
    console.error('Upload failed:', err.response?.data ?? err.message);

    if (err.response?.status === 422) {
      errors.value = err.response.data.errors;
    }
  }
}
</script>
<style scoped></style>