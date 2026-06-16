@php
    $publishedPrograms = [
        ['program' => 'BS Computer Science', 'code' => 'BSCS', 'year' => '2025 – 2026', 'status' => 'Published', 'date' => 'Jun 10, 2026'],
        ['program' => 'BS Information Technology', 'code' => 'BSIT', 'year' => '2026 – 2027', 'status' => 'Draft', 'date' => 'Jun 14, 2026'],
    ];
@endphp

<x-admin.layout title="Academic Advisement">
    <div class="mb-6">
        <h2 class="text-sm font-bold uppercase tracking-wide text-gray-900">Publish Curriculum</h2>
        <p class="mt-1 text-sm text-gray-500">Review and publish approved curriculum to make it available system-wide.</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="space-y-6 lg:col-span-2">
            <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
                <h3 class="mb-5 text-sm font-bold uppercase tracking-wide text-gray-900">Select Program to Publish</h3>

                <div class="grid gap-4 sm:grid-cols-2">
                    <x-admin.form-field label="Program" name="publish_program" type="select">
                        <option value="">Select program</option>
                        <option selected>BS Information Technology</option>
                        <option>BS Computer Science</option>
                    </x-admin.form-field>
                    <x-admin.form-field label="Curriculum Year" name="publish_year" type="select">
                        <option selected>2026 – 2027</option>
                        <option>2025 – 2026</option>
                    </x-admin.form-field>
                    <x-admin.form-field label="Effective Term" name="effective_term" type="select" class="sm:col-span-2">
                        <option selected>1st Semester, AY 2026–2027</option>
                        <option>2nd Semester, AY 2026–2027</option>
                    </x-admin.form-field>
                </div>

                <div class="mt-6 rounded-md border border-amber-200 bg-amber-50 px-4 py-3 text-sm text-amber-900">
                    Publishing will make this curriculum visible to advisers, students, and OUR staff. Ensure the prospectus has been reviewed.
                </div>

                <div class="mt-6 flex flex-wrap justify-center gap-4">
                    <x-admin.button variant="primary">Publish Curriculum</x-admin.button>
                    <x-admin.button variant="secondary">Cancel</x-admin.button>
                </div>
            </div>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-5 shadow-sm">
            <h3 class="mb-4 text-sm font-bold uppercase tracking-wide text-gray-900">Publication Status</h3>

            <ul class="space-y-4">
                @foreach ($publishedPrograms as $item)
                    <li class="rounded-md border border-gray-100 bg-gray-50 p-4">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $item['program'] }}</p>
                                <p class="text-xs text-gray-500">{{ $item['code'] }} · {{ $item['year'] }}</p>
                            </div>
                            <span @class([
                                'shrink-0 rounded-full px-2 py-0.5 text-xs font-semibold',
                                'bg-green-100 text-green-800' => $item['status'] === 'Published',
                                'bg-gray-200 text-gray-700' => $item['status'] === 'Draft',
                            ])>
                                {{ $item['status'] }}
                            </span>
                        </div>
                        <p class="mt-2 text-xs text-gray-500">Last updated: {{ $item['date'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-admin.layout>
