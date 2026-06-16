@props([
    'title',
    'courses' => [],
])

<div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
    <div class="flex items-center gap-2 bg-up-maroon px-4 py-2.5 text-sm font-bold uppercase tracking-wide text-white">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        {{ $title }}
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full text-xs">
            <thead>
                <tr class="bg-up-green text-left font-bold uppercase tracking-wide text-white">
                    <th class="px-3 py-2 text-center">#</th>
                    <th class="px-3 py-2">Course Code</th>
                    <th class="px-3 py-2">Course Title</th>
                    <th class="px-3 py-2 text-center">Units</th>
                    <th class="px-3 py-2 text-center">Type</th>
                    <th class="px-3 py-2">Pre-requisite</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($courses as $course)
                    <tr class="bg-white even:bg-gray-50/80">
                        <td class="px-3 py-2 text-center text-gray-600">{{ $course['no'] }}</td>
                        <td class="px-3 py-2 font-medium">{{ $course['code'] }}</td>
                        <td class="px-3 py-2">{{ $course['title'] }}</td>
                        <td class="px-3 py-2 text-center">{{ $course['units'] }}</td>
                        <td class="px-3 py-2 text-center">{{ $course['type'] }}</td>
                        <td class="px-3 py-2 text-gray-600">{{ $course['prerequisite'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="border-t border-gray-200 bg-gray-50 px-4 py-2 text-xs text-gray-700">
        Current total units: <span class="font-bold text-up-green">{{ collect($courses)->sum('units') }}</span>
    </div>
</div>
