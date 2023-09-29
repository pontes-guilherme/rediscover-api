<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = ['Back-End', 'Front-End', 'Full Stack', 'Compilers', 'Tools', 'Security', 'Learn in Public'];

        Tag::insert(
            collect($items)->map(fn($item) => ['name' => $item])->toArray()
        );
    }
}
