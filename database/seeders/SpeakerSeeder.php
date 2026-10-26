<?php

namespace Database\Seeders;

use App\Models\Speaker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SpeakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = resource_path('speakers.json');
        if (! File::exists($jsonPath)) {
            return;
        }

        $items = json_decode(File::get($jsonPath), true);
        if (empty($items)) {
            return;
        }

        Speaker::truncate();

        foreach ($items as $item) {
            $fullName = ($item['degree_vi'] ? $item['degree_vi'].' ' : '').$item['name'];
            $title = ! empty($item['position_vi']) ? $item['position_vi'] : ($item['degree_vi'] ?: null);

            Speaker::create([
                'name' => $fullName,
                'title' => $title,
                'affiliation' => $item['organization_vi'],
                'photo_path' => $item['photo_path'],
                'sort_order' => $item['stt'],
                'bio_vi' => $item['position_vi'],
                'bio_en' => $item['position_en'],
                'is_published' => true,
            ]);
        }
    }
}
