<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Nisrina',
            'username' => 'nisrina.aulia',
            'email' => 'nisrina@gmail.com',
            'password' => bcrypt('12345') 
        ]);

        // User::create([
        //     'name' => 'Syifa',
        //     'email' => 'syifa@gmail.com',
        //     'password' => bcrypt('54321') 
        // ]);
        User::factory(3)->create();
       
        Category::create([
            'name' => 'Ayam',
            'slug' => 'ayam'
        ]);
        
        Category::create([
            'name' => 'Buah',
            'slug' => 'buah'
        ]); 

        Category::create([
            'name' => 'Mie',
            'slug' => 'mie'
        ]);

        Post::factory(20)->create();

        // Post::create([
        //     'judul' => 'Jus Alpukat',
        //     'slug' => 'jus-alpukat',
        //     'excerpt' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laudantium dignissimos sunt nisi recusandae molestias tempore maxime placeat nostrum nihil.',
        //     'isi' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laudantium dignissimos sunt nisi recusandae molestias tempore maxime placeat nostrum nihil. Non atque dolore dolor hic velit, repellat iste, fuga quam numquam ipsam dignissimos quo corporis eveniet error repudiandae quidem. Ipsum debitis, odio incidunt atque itaque non accusantium rerum, tempore ea magni nisi voluptates soluta asperiores temporibus. Ad, iste eum a quas distinctio blanditiis laudantium commodi consectetur tenetur, nulla est non esse necessitatibus sed perspiciatis adipisci autem ex dignissimos praesentium inventore quo ut voluptate suscipit dolor. Excepturi molestiae architecto hic cumque, voluptas autem ducimus incidunt quaerat necessitatibus, aspernatur veniam porro quis vitae.' ,
        //     'category_id' => 1,
        //     'user_id' => 2
        // ]);

        // Post::create([
        //     'judul' => 'Mie Ayam',
        //     'slug' => 'mie-ayam',
        //     'excerpt' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laudantium dignissimos sunt nisi recusandae molestias tempore maxime placeat nostrum nihil.',
        //     'isi' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laudantium dignissimos sunt nisi recusandae molestias tempore maxime placeat nostrum nihil. Non atque dolore dolor hic velit, repellat iste, fuga quam numquam ipsam dignissimos quo corporis eveniet error repudiandae quidem. Ipsum debitis, odio incidunt atque itaque non accusantium rerum, tempore ea magni nisi voluptates soluta asperiores temporibus. Ad, iste eum a quas distinctio blanditiis laudantium commodi consectetur tenetur, nulla est non esse necessitatibus sed perspiciatis adipisci autem ex dignissimos praesentium inventore quo ut voluptate suscipit dolor. Excepturi molestiae architecto hic cumque, voluptas autem ducimus incidunt quaerat necessitatibus, aspernatur veniam porro quis vitae.' ,
        //     'category_id' => 2,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'judul' => 'Jus Mangga',
        //     'slug' => 'jus-mangga',
        //     'excerpt' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laudantium dignissimos sunt nisi recusandae molestias tempore maxime placeat nostrum nihil.',
        //     'isi' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laudantium dignissimos sunt nisi recusandae molestias tempore maxime placeat nostrum nihil. Non atque dolore dolor hic velit, repellat iste, fuga quam numquam ipsam dignissimos quo corporis eveniet error repudiandae quidem. Ipsum debitis, odio incidunt atque itaque non accusantium rerum, tempore ea magni nisi voluptates soluta asperiores temporibus. Ad, iste eum a quas distinctio blanditiis laudantium commodi consectetur tenetur, nulla est non esse necessitatibus sed perspiciatis adipisci autem ex dignissimos praesentium inventore quo ut voluptate suscipit dolor. Excepturi molestiae architecto hic cumque, voluptas autem ducimus incidunt quaerat necessitatibus, aspernatur veniam porro quis vitae.' ,
        //     'category_id' => 1,
        //     'user_id' => 2
        // ]);
    }
}
