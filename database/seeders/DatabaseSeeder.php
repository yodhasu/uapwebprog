<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(ProductSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(WalletSeeder::class);
    }
}
