<template>
  <div class="relative flex min-h-screen items-center justify-center p-6">
    <!-- Background Image with Dark Overlay -->
    <div class="absolute inset-0 z-0">
      <img src="/up-cebu.png" alt="UP Cebu Campus" class="h-full w-full object-cover" />
      <div class="absolute inset-0 bg-black/60"></div>
    </div>
    
    <!-- Main Content -->
    <!-- Main Content -->
    <div class="relative z-10 w-full max-w-md rounded-2xl bg-white p-8 shadow-2xl">
      <div class="mb-8 text-center">
        <img
          src="/images/logos/up-logo.png"
          alt="UP Cebu"
          class="mx-auto mb-5 h-16 w-auto object-contain"
        >
        <p class="text-sm font-semibold tracking-wide text-up-maroon uppercase">Advisement Management System</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-slate-900">Login</h1>
      </div>
      <slot />
    </div>
  </div>
</template>
