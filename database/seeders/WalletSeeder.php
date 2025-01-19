<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wallet;
use App\Models\User;

class WalletSeeder extends Seeder
{
    public function run()
    {
        // Assuming you have users already
        $users = User::all();

        foreach ($users as $user) {
            Wallet::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'address' => 'Sample Address', // You can customize this
                'balance' => 0.00,
                'points' => 0.00,
            ]);
        }
    }
}
