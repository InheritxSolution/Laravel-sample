<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'user_role' => 1,
            'status' => 1,
            'created_at' => date('Y-m-d h:i:s'),            
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table('cms')->insert([
            'content' => '<h2>Content Title</h2><p>this is test content</p>',
            'lang' => 'en',
            'type' => 'privacy-policy',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
    }
}
