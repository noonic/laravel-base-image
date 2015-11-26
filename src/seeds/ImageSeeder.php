<?php

use Illuminate\Database\Seeder;

use Noonic\Image\Models\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear data
        Image::query()->truncate();

        // Add data
        Image::create([
            'title' => 'test',
            'description' => 'Test',
            'path' => 'test/test.jpg',
            'status' => 1,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}