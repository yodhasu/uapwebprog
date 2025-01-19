<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $filePath = storage_path('app\CategoryDB.csv');

        if (!file_exists($filePath)) {
            $this->command->error("File not found: {$filePath}");
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $headers = array_shift($data); // Extract headers

        foreach ($data as $row) {
            $rowData = array_combine($headers, $row);

            Category::create([
                'product_id' => $rowData['ProductID'],
                'product_category' => $rowData['ProductCategory'],
            ]);
        }
    }
}
