@props(['courses' => []])

<div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="bg-up-green text-left text-xs font-bold uppercase tracking-wide text-white">
                    <th class="px-4 py-3 text-center">#</th>
                    <th class="px-4 py-3">Course Code</th>
                    <th class="px-4 py-3">Course Title</th>
                    <th class="px-4 py-3 text-center">Units</th>
                    <th class="px-4 py-3 text-center">Type</th>
                    <th class="px-4 py-3">Pre-requisite</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach ($courses as $course)
                    <tr @class(['bg-white' => $loop->even, 'bg-gray-50/80' => $loop->odd])>
                        <td class="px-4 py-3 text-center text-gray-600">{{ $course['no'] }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $course['code'] }}</td>
                        <td class="px-4 py-3 text-gray-800">{{ $course['title'] }}</td>
                        <td class="px-4 py-3 text-center text-gray-700">{{ $course['units'] }}</td>
                        <td class="px-4 py-3 text-center text-gray-700">{{ $course['type'] }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $course['prerequisite'] }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <button type="button" class="rounded p-1 text-blue-600 hover:bg-blue-50" aria-label="Edit">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button type="button" class="rounded p-1 text-red-600 hover:bg-red-50" aria-label="Delete">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="border-t border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700">
        Current total units: <span class="font-bold text-up-green">{{ collect($courses)->sum('units') }}</span>
    </div>
</div>
