<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $filePath = storage_path('app\ProductDB.csv');

        if (!file_exists($filePath)) {
            $this->command->error("File not found: {$filePath}");
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $headers = array_shift($data); // Extract headers

        foreach ($data as $row) {
            $rowData = array_combine($headers, $row);

            Product::create([
                'name' => $rowData['ProductName'],
                'category' => $rowData['Category'],
            ]);
        }
    }
}
