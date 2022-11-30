<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Enums\StatusEnum;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $users = collect(User::all()->modelKeys());
        $categories = collect(Category::all()->modelKeys());
        $status = collect(['published','draft','process']);
        $data = [];

        for ($i = 0; $i < 100; $i++) {
            $title = $faker->sentence;
            $data[] = [
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => $faker->text,
                'image' => 'post/example-image.jpg',
                'category_id' => $categories->random(),
                'user_id' => $users->random(),
                'status' => $status->random(),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }

        $chunks = array_chunk($data, 100);
        foreach ($chunks as $chunk) {
            Post::insert($chunk);
        }
    }

}
