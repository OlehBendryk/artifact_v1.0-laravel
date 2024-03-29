<?php

namespace Database\Seeders;

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
        // \App\Models\Moderator::factory(10)->create();
        $this->call(SubdomainSeeder::class);
        $this->call(SuperadminSeder::class);
        $this->call(RoleAndPermissionSeeder::class);
    }
}
