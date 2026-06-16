@php
    $semesters = [
        [
            'title' => '1st Year – 1st Semester',
            'courses' => [
                ['no' => 1, 'code' => 'IT 101', 'title' => 'Introduction to Computing', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'None'],
                ['no' => 2, 'code' => 'MATH 101', 'title' => 'College Algebra', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'None'],
                ['no' => 3, 'code' => 'ENG 101', 'title' => 'Communication Skills 1', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'None'],
                ['no' => 4, 'code' => 'CMSC 11', 'title' => 'Foundation of Computer Science', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'None'],
                ['no' => 5, 'code' => 'ETHICS 1', 'title' => 'Ethics and Moral Reasoning', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'None'],
            ],
        ],
        [
            'title' => '1st Year – 2nd Semester',
            'courses' => [
                ['no' => 1, 'code' => 'IT 102', 'title' => 'Computer Programming 1', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'IT 101'],
                ['no' => 2, 'code' => 'MATH 102', 'title' => 'Trigonometry', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'MATH 101'],
                ['no' => 3, 'code' => 'ENG 102', 'title' => 'Communication Skills 2', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'ENG 101'],
                ['no' => 4, 'code' => 'PHYS 101', 'title' => 'General Physics', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'None'],
            ],
        ],
        [
            'title' => '2nd Year – 1st Semester',
            'courses' => [
                ['no' => 1, 'code' => 'IT 201', 'title' => 'Data Structures', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'IT 102'],
                ['no' => 2, 'code' => 'IT 202', 'title' => 'Database Systems', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'IT 101'],
                ['no' => 3, 'code' => 'STAT 201', 'title' => 'Statistics', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'MATH 101'],
            ],
        ],
        [
            'title' => '2nd Year – 2nd Semester',
            'courses' => [
                ['no' => 1, 'code' => 'IT 203', 'title' => 'Web Development', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'IT 201'],
                ['no' => 2, 'code' => 'IT 204', 'title' => 'Networking Fundamentals', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'IT 101'],
            ],
        ],
    ];
@endphp

<x-admin.layout title="Academic Advisement">
    <div class="mb-6">
        <h2 class="text-sm font-bold uppercase tracking-wide text-gray-900">
            Review / Check Before Prospectus Before Generation
        </h2>
        <p class="mt-1 text-sm text-gray-500">BS Computer Science · 2025–2026</p>
    </div>

    {{-- Summary stat cards --}}
    <div class="mb-6 grid gap-4 sm:grid-cols-3">
        <div class="flex items-center gap-4 rounded-lg border border-green-200 bg-white p-5 shadow-sm">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-green-100 text-green-700">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase text-gray-500">Total units</p>
                <p class="text-3xl font-bold text-green-700">153</p>
            </div>
        </div>
        <div class="flex items-center gap-4 rounded-lg border border-blue-200 bg-white p-5 shadow-sm">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase text-gray-500">Semesters</p>
                <p class="text-3xl font-bold text-blue-700">8</p>
            </div>
        </div>
        <div class="flex items-center gap-4 rounded-lg border border-yellow-200 bg-white p-5 shadow-sm">
            <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-yellow-100 text-yellow-700">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase text-gray-500">Year level</p>
                <p class="text-3xl font-bold text-yellow-700">4</p>
            </div>
        </div>
    </div>

    {{-- Action buttons --}}
    <div class="mb-8 flex flex-wrap items-center gap-4">
        <x-admin.button variant="primary">Generate &amp; Publish</x-admin.button>
        <div class="flex flex-wrap gap-3">
            <x-admin.button variant="primary-sm">Print Preview</x-admin.button>
            <x-admin.button variant="primary-sm">Export Prospectus</x-admin.button>
        </div>
    </div>

    {{-- Semester grid --}}
    <div class="grid gap-6 lg:grid-cols-2">
        @foreach ($semesters as $semester)
            <x-admin.semester-table
                :title="$semester['title']"
                :courses="$semester['courses']"
            />
        @endforeach
    </div>
</x-admin.layout>
