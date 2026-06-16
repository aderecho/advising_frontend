<script setup lang="ts">
definePageMeta({ layout: 'guest' })

const email = ref('')
const password = ref('')
const remember = ref(false)

function submit() {
  navigateTo('/admin/curriculum-builder')
}

function demoLogin(role: 'admin' | 'our' | 'student') {
  const routes = {
    admin: '/admin/curriculum-builder',
    our: '/our/course-catalog',
    student: '/student/dashboard',
  }
  navigateTo(routes[role])
}
</script>

<template>
  <div class="rounded-2xl border border-slate-200/80 bg-white p-8 shadow-[var(--shadow-card)]">
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
        Sign in
      </button>
    </form>

    <div class="mt-6 border-t border-slate-100 pt-5">
      <p class="mb-3 text-center text-xs font-medium text-slate-400 uppercase tracking-wide">Demo access</p>
      <div class="grid grid-cols-3 gap-2">
        <button
          type="button"
          class="rounded-xl border border-slate-200 py-2 text-xs font-semibold text-slate-600 transition hover:border-up-maroon/30 hover:bg-up-maroon/5 hover:text-up-maroon"
          @click="demoLogin('admin')"
        >
          Admin UI
        </button>
        <button
          type="button"
          class="rounded-xl border border-slate-200 py-2 text-xs font-semibold text-slate-600 transition hover:border-up-maroon/30 hover:bg-up-maroon/5 hover:text-up-maroon"
          @click="demoLogin('our')"
        >
          OUR UI
        </button>
        <button
          type="button"
          class="rounded-xl border border-slate-200 py-2 text-xs font-semibold text-slate-600 transition hover:border-up-maroon/30 hover:bg-up-maroon/5 hover:text-up-maroon"
          @click="demoLogin('student')"
        >
          Student UI
        </button>
      </div>
    </div>
  </div>
</template>
