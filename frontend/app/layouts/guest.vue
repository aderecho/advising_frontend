<template>
  <div class="flex min-h-screen items-center justify-center bg-surface p-6">
    <div class="w-full max-w-md">
      <div class="mb-8 text-center">
        <img
          src="/images/logos/up-logo.png"
          alt="UP Cebu"
          class="mx-auto mb-5 h-14 w-auto object-contain"
        >
        <p class="text-sm font-medium text-up-maroon">Advisement Management System</p>
        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-slate-900">Sign in to AMIS</h1>
        <p class="mt-2 text-sm text-slate-500">University of the Philippines Cebu</p>
      </div>
      <slot />
    </div>
  </div>
</template>
