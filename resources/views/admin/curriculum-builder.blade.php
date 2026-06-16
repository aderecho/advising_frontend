@php
    $courses = [
        ['no' => 1, 'code' => 'IT 101', 'title' => 'Introduction to Computing', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'None'],
        ['no' => 2, 'code' => 'MATH 101', 'title' => 'College Algebra', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'None'],
        ['no' => 3, 'code' => 'ENG 101', 'title' => 'Communication Skills 1', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'CMSC 12'],
        ['no' => 4, 'code' => 'CMSC 11', 'title' => 'Foundation of Computer Science', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'None'],
        ['no' => 5, 'code' => 'ETHICS 1', 'title' => 'Ethics and Moral Reasoning', 'units' => 3, 'type' => 'LEC', 'prerequisite' => 'None'],
    ];
@endphp

<x-admin.layout title="Academic Advisement">
    <div class="grid gap-6 xl:grid-cols-3">
        {{-- Program & course forms --}}
        <div class="space-y-6 xl:col-span-2">
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <h2 class="mb-5 text-sm font-bold uppercase tracking-wide text-gray-900">Enter Program Information</h2>

                <div class="grid gap-4 sm:grid-cols-2">
                    <x-admin.form-field label="Program Name" name="program_name" placeholder="Enter Program Name" class="sm:col-span-2" />
                    <x-admin.form-field label="Curriculum Year" name="curriculum_year" type="select">
                        <option value="">Select Curriculum Year</option>
                        <option>2025 – 2026</option>
                        <option selected>2026 – 2027</option>
                    </x-admin.form-field>
                    <x-admin.form-field label="Department / College" name="department" type="select">
                        <option value="">Select Department/College</option>
                        <option selected>College of Science</option>
                        <option>College of Communication, Art and Design</option>
                    </x-admin.form-field>
                    <x-admin.form-field label="Program Duration" name="duration" type="select" class="sm:col-span-2">
                        <option value="">Select Program Duration</option>
                        <option selected>4 years</option>
                        <option>5 years</option>
                    </x-admin.form-field>
                </div>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <h2 class="mb-5 text-sm font-bold uppercase tracking-wide text-gray-900">Enter Program Information</h2>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <x-admin.form-field label="Course Code" name="course_code" placeholder="e.g. IT 101" />
                    <x-admin.form-field label="Course Title" name="course_title" placeholder="Enter course title" class="sm:col-span-2 lg:col-span-1" />
                    <x-admin.form-field label="Units" name="units" placeholder="3" />
                    <x-admin.form-field label="Pre-requisite" name="prerequisite" placeholder="None" />
                    <x-admin.form-field label="New Semester" name="semester" placeholder="1st Semester" />
                </div>

                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <x-admin.button variant="primary">Save Program</x-admin.button>
                    <x-admin.button variant="secondary">Reset All</x-admin.button>
                </div>
            </div>
        </div>

        {{-- Curriculum summary --}}
        <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-sm font-bold uppercase tracking-wide text-gray-900">Curriculum Summary</h2>
                <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-800">
                    <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                    Active
                </span>
            </div>

            <ul class="space-y-3 text-sm">
                @foreach ([
                    ['Program', 'BS Information Technology'],
                    ['Program code', 'BSIT'],
                    ['Curriculum year', '2026 – 2027'],
                    ['Active term', '1st Semester'],
                    ['Department', 'College of Science'],
                    ['Duration', '4 years'],
                ] as [$label, $value])
                    <li class="flex items-start gap-3">
                        <span class="mt-0.5 flex h-5 w-5 shrink-0 items-center justify-center rounded bg-up-maroon/10 text-up-maroon">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                        <div>
                            <p class="text-xs font-semibold uppercase text-gray-500">{{ $label }}</p>
                            <p class="font-medium text-gray-900">{{ $value }}</p>
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="mt-6 grid grid-cols-2 gap-3">
                <div class="rounded-md bg-gray-100 px-3 py-3 text-center">
                    <p class="text-xs text-gray-500">Courses added</p>
                    <p class="text-xl font-bold text-gray-900">2</p>
                </div>
                <div class="rounded-md bg-gray-100 px-3 py-3 text-center">
                    <p class="text-xs text-gray-500">Total units</p>
                    <p class="text-xl font-bold text-gray-900">6</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Course list section --}}
    <div class="mt-8 rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <div class="mb-5 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-sm font-bold uppercase tracking-wide text-gray-900">Select &amp; Display Course List</h2>
                <p class="mt-1 text-sm text-gray-500">BS Computer Science · 2025–2026</p>
            </div>
            <div class="flex flex-wrap items-end gap-3">
                <x-admin.form-field label="Year Level" name="year_level" type="select" class="min-w-[140px]">
                    <option selected>1st Year</option>
                    <option>2nd Year</option>
                    <option>3rd Year</option>
                    <option>4th Year</option>
                </x-admin.form-field>
                <x-admin.form-field label="Semester" name="semester_filter" type="select" class="min-w-[140px]">
                    <option selected>1st Semester</option>
                    <option>2nd Semester</option>
                    <option>Midyear</option>
                </x-admin.form-field>
                <x-admin.button variant="primary-sm" class="mb-0.5">Duplicate Semesters</x-admin.button>
            </div>
        </div>

        <x-admin.course-table :courses="$courses" />
    </div>
</x-admin.layout>
