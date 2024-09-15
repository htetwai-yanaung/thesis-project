<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Core\App\Models\Year;
use Modules\Core\App\Models\UserRole;
use Modules\Core\Database\Seeders\YearSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(30)->create();

        // \Modules\Core\App\Models\News::factory(10)->create();
        // \Modules\Core\App\Models\ThesisProject::factory(10)->create();

        // for($i = 1; $i <= 10; $i++){
        //     \Modules\Core\App\Models\Image::factory()->create(['parent_id' => $i, 'image_type' => 'news']);
        // }
        // for($i = 1; $i <= 10; $i++){
        //     \Modules\Core\App\Models\Image::factory()->create(['parent_id' => $i, 'image_type' => 'project']);
        // }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $roles = ['Admin', 'Teacher', 'Student'];
        // foreach($roles as $role){
        //     UserRole::create([
        //         'role' => $role,
        //     ]);
        // }

        // $years = ['First Year', 'Second Year', 'Third Year', 'Fourth Year', 'Fifth Year', 'Sixth Year'];
        // foreach($years as $year){
        //     Year::create([
        //         'year' => $year,
        //     ]);
        // }
    }
}
