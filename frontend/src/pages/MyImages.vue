<template>
  <div>
    <header class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">My Images</h1>
      </div>
    </header>
    <main>
      <div v-if="loading" class="mx-auto max-w-7xl px-4 py-6 flex justify-center">
        <p>Loading images...</p>
      </div>

      <div v-else-if="error" class="mx-auto max-w-7xl px-4 py-6 text-red-500">
        {{ error }}
      </div>

      <div v-else-if="images.length === 0" class="mx-auto max-w-7xl px-4 py-6 text-gray-500">
        No images found.
      </div>

      <div v-else class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
          <div v-for="image in images" :key="image.id" class="bg-white overflow-hidden shadow rounded-lg">
            <img :src="image.url" alt="Image" class="w-full h-48 object-contain">
            <div class="px-4 py-4">
              <h3 class="text-lg font-semibold text-gray-900">{{ image.name }}</h3>
              <p class="text-sm text-gray-500 mb-4">{{ image.label }}</p>
              <div class="flex justify-between items-center">
              <button type="button" @click="copyImageUrl(image.url)"
              class="rounded-sm bg-indigo-600 px-3 py-2 text-sm
                 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2
                focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Copy Url</button>
              <button type="button" @click="deleteImage(image.id)"
              class="rounded-sm bg-red-600 px-3 py-2 text-sm
                 font-semibold text-white shadow-xs hover:bg-red-500 focus-visible:outline-2
                focus-visible:outline-offset-2 focus-visible:outline-red-600">Delete</button>
                </div>
            </div>
          </div>
        </div>
      </div>

    </main>
  </div>
</template>

<script setup>
import axiosClient from "../axios";
import { onMounted, ref } from "vue";

const images = ref([]);
const loading = ref(true);
const error = ref(null);

onMounted(() => {
  axiosClient.get("/api/images")
    .then((response) => {
      images.value = response.data;
    })
    .catch((err) => {
      error.value = "Failed to load images. Please try again later.";
      console.error("API Error:", err);
    })
    .finally(() => {
      loading.value = false;
    });
});

async function deleteImage(id) {
  if (!confirm("Are you sure you want to delete this image?")) {
    return;
  }

  try {
    await axiosClient.delete(`/api/images/${id}`);
    images.value = images.value.filter((image) => image.id !== id);
  } catch (err) {
    console.error("API Error:", err);
  }
}

async function copyImageUrl(url) {
 await navigator.clipboard.writeText(url)
    .then(() => {
      alert("URL copied to clipboard!");
    })
    .catch((err) => {
      console.error("Failed to copy URL:", err);
    });
}

</script>