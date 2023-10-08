<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = ['Java', 'Spring Boot', 'PHP', 'Laravel', 'Symphony', 'Zend', 'Python', 'Flask', 'FastAPI', 'Javascript', 'Node', 'Express', 'NestJS', 'ReactJS', 'React Native', 'VueJS', 'Angular', 'Svelte', 'PostgreSQL', 'Mysql', 'MongoDB'];

        Technology::insert(
            collect($items)->map(fn($item) => ['name' => $item])->toArray()
        );
    }
}
