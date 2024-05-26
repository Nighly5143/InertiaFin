<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineOptions({
    layout: AuthenticatedLayout
});

</script>

<template>
    <Head title="Dashboard" />
  
    <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-4 ml-5">Dashboard</h2>
  
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-1 flex justify-center">
            <img src="../Components/home.png" alt="me" class="welcome-img welcome" />
          </div>
        </div>
      </div>
    </div>
  </template>
