<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurriculumLookupSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $curriculumYears = [
            ['code' => '2023-2024', 'label' => '2023 – 2024'],
            ['code' => '2024-2025', 'label' => '2024 – 2025'],
            ['code' => '2025-2026', 'label' => '2025 – 2026'],
            ['code' => '2026-2027', 'label' => '2026 – 2027'],
            ['code' => '2027-2028', 'label' => '2027 – 2028'],
        ];

        foreach ($curriculumYears as $year) {
            DB::table('curriculum_years')->updateOrInsert(
                ['code' => $year['code']],
                [
                    'label' => $year['label'],
                    'is_active' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            );
        }

        $colleges = [
            ['code' => 'ccad', 'name' => 'College of Communication, Art and Design'],
            ['code' => 'cos', 'name' => 'College of Science'],
            ['code' => 'som', 'name' => 'School of Management'],
        ];

        foreach ($colleges as $college) {
            DB::table('colleges')->updateOrInsert(
                ['code' => $college['code']],
                [
                    'name' => $college['name'],
                    'is_active' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            );
        }

        $durations = [
            ['code' => '2-years', 'label' => '2 years', 'years' => 2],
            ['code' => '4-years', 'label' => '4 years', 'years' => 4],
            ['code' => '5-years', 'label' => '5 years', 'years' => 5],
        ];

        foreach ($durations as $duration) {
            DB::table('program_durations')->updateOrInsert(
                ['code' => $duration['code']],
                [
                    'label' => $duration['label'],
                    'years' => $duration['years'],
                    'is_active' => true,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            );
        }
    }
}
