<script setup lang="ts">
definePageMeta({ layout: 'guest' })

const email = ref('')
const password = ref('')
const remember = ref(false)

function submit() {
  navigateTo('/admin/curriculum-builder')
}

</script>

<template>
  <div>
    <form class="space-y-5" @submit.prevent="submit">
      <div>
        <label for="email" class="mb-2 block text-sm font-medium text-slate-700">Email</label>
        <input
          id="email"
          v-model="email"
          type="email"
          class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-800 outline-none transition focus:border-up-maroon/40 focus:bg-white focus:ring-4 focus:ring-up-maroon/10"
        >
      </div>

      <div>
        <label for="password" class="mb-2 block text-sm font-medium text-slate-700">Password</label>
        <input
          id="password"
          v-model="password"
          type="password"
          class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 py-2.5 text-sm text-slate-800 outline-none transition focus:border-up-maroon/40 focus:bg-white focus:ring-4 focus:ring-up-maroon/10"
        >
      </div>

      <label class="flex items-center gap-2 text-sm text-slate-600">
        <input v-model="remember" type="checkbox" class="rounded border-slate-300 text-up-maroon focus:ring-up-maroon/20">
        Remember me
      </label>

      <button
        type="submit"
        class="w-full rounded-xl bg-up-maroon py-2.5 text-sm font-semibold text-white shadow-sm shadow-up-maroon/20 transition hover:bg-up-maroon-dark active:scale-[0.99]"
      >
       Login
      </button>
    </form>
  </div>
</template>
