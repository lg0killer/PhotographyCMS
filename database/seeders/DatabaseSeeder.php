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

        // delete files
        $except_file_names = [
            '.gitignore',
            // file name (storage/app/public/<file_name>)
        ];
        $file_paths = $fs->files(public_path('photos'));
        foreach ($file_paths as $file_path) {
            $file_name = last(explode('/', $file_path));
            if (!in_array($file_name, $except_file_names)) {
                $fs->delete($file_path);
            }
        }

        \App\Models\Award::factory()->create([
            'name' => 'Best of grade',
        ]);
        \App\Models\Award::factory()->create([
            'name' => 'Best of juniors',
        ]);
        \App\Models\Award::factory()->create([
            'name' => 'Best of seniors',
        ]);
        \App\Models\Award::factory()->create([
            'name' => 'Best of evening',
        ]);
        \App\Models\Award::factory()->create([
            'name' => 'Best of theme',
        ]);

        //Create new categories
        \App\Models\Category::factory()->create([
            'name' => 'Altered Reality',
            'description' => 'Computer generated images. Manipulated images. Must stimulate the viewer’s mind through creative use of line, form and colour.',
            'short_code' => 'AR',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Nature',
            'description' => 'Photos of nature',
            'short_code' => 'NA',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Pictorial',
            'description' => 'Open category. Images that aren’t defined in any other category.',
            'short_code' => 'PI',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Scapes',
            'description' => 'Landscapes, No human elements, manipulation, animals, farm or zoo animals, hybrid plants or flowers are allowed.',
            'short_code' => 'SC',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Theme',
            'description' => 'Subject selected by committee every month. Image creativity is at the discretion of the author but must have relevance to the theme. Manipulation allowed.',
            'short_code' => 'TH',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Photojournalism',
            'description' => 'Storytelling pictures. Documentary Pictures. Human Interest. No manipulation allowed that alters the truth. Journalistic value of picture weigh more than pictorial quality.',
            'short_code' => 'PJ',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Portrait',
            'description' => 'Head and shoulders or full figure of person(s) / animal(s). Studio.',
            'short_code' => 'PO',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'Cellphone',
            'description' => 'Picture taken with a cellphone camera. A C to be placed in front of category code. For example: CPO; CPI; CNA; CPJ; CAR',
            'short_code' => 'C',
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
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'is_admin' => true,
        ]);

        \App\Models\StarLevel::factory()->create([
            'name' => '1',
        ]);
        \App\Models\StarLevel::factory()->create([
            'name' => '2',
        ]);
        \App\Models\StarLevel::factory()->create([
            'name' => '3',
        ]);
        \App\Models\StarLevel::factory()->create([
            'name' => '4',
        ]);
        \App\Models\StarLevel::factory()->create([
            'name' => '5',
        ]);
        \App\Models\StarLevel::factory()->create([
            'name' => '5H',
        ]);
    }
}
