<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Filesystem\Filesystem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Detele all files and folders in storage/app/public
        $fs = new Filesystem;

        // delete directories
        $except_folder_names = [
            // folder name (storage/app/public/<folder_name>)
        ];
        $folder_paths = $fs->directories(public_path('storage'));
        foreach ($folder_paths as $folder_path) {
            $folder_name = last(explode('/', $folder_path));
            if (!in_array($folder_name, $except_folder_names)) {
                $fs->deleteDirectory($folder_path);
            }
        }

        // delete files
        $except_file_names = [
            '.gitignore',
            // file name (storage/app/public/<file_name>)
        ];
        $file_paths = $fs->files(public_path('storage'));
        foreach ($file_paths as $file_path) {
            $file_name = last(explode('/', $file_path));
            if (!in_array($file_name, $except_file_names)) {
                $fs->delete($file_path);
            }
        }

        //Create new categories
        \App\Models\Category::factory()->create([
            'name' => 'Nature',
            'description' => 'Photos of nature',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Animals',
            'description' => 'Photos of animals',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'People',
            'description' => 'Photos of people',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Food',
            'description' => 'Photos of food',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Sports',
            'description' => 'Photos of sports',
        ]);

        //Create new themes
        \App\Models\Theme::factory()->create([
            'name' => 'Shapes',
            'description' => 'Photos of January',
            'month' => 'January',
            'year' => 2023,
        ]);

        \App\Models\Theme::factory()->create([
            'name' => 'Colors',
            'description' => 'Photos of February',
            'month' => 'February',
            'year' => 2023,
        ]);

        \App\Models\Theme::factory()->create([
            'name' => 'Textures',
            'description' => 'Photos of March',
            'month' => 'March',
            'year' => 2023,
        ]);

        //Create new users and assign photos to them
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => true,
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
        ]);
        \App\Models\Photo::factory(10)->create([
            'by_user_id' => 1]);
            
        \App\Models\Photo::factory(10)->create([
            'by_user_id' => 2]);
            
    }
}
