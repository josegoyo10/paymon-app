<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
            $categories = [
                ['name' => 'Matemáticas', 'description' => 'Cursos de matemáticas para todas las edades'],
                ['name' => 'Ciencia', 'description' => 'Cursos sobre diversas ramas de la ciencia'],
                ['name' => 'Arte', 'description' => 'Cursos para aprender diversas expresiones artísticas'],
                ['name' => 'Tecnología', 'description' => 'Cursos sobre programación y tecnología'],
            ];
    
            foreach ($categories as $category) {
                Category::create($category);
            }
       
    }
}
