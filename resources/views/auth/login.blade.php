<x-layouts.guest title="Sign in">
    <x-ui.card class="border-slate-800 bg-slate-900 text-slate-100">
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-slate-300">Email</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-white outline-none focus:border-red-500"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-slate-300">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    class="w-full rounded-lg border border-slate-700 bg-slate-950 px-3 py-2 text-sm text-white outline-none focus:border-red-500"
                >
            </div>

            <label class="flex items-center gap-2 text-sm text-slate-400">
                <input type="checkbox" name="remember" class="rounded border-slate-600 bg-slate-950">
                Remember me
            </label>

            <x-ui.button type="submit" class="w-full">Sign in</x-ui.button>
        </form>
    </x-ui.card>

    <p class="mt-6 text-center text-xs text-slate-500">
        Demo password for all seeded users: <span class="font-mono text-slate-300">password</span>
    </p>
</x-layouts.guest>
