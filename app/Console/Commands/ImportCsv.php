<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ImportCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:csv {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from a CSV file into the products table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->argument('file');

        if (!Storage::exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return 1;
        }

        $data = array_map('str_getcsv', file(Storage::path($filePath)));
        $headers = array_shift($data); // Extract headers

        foreach ($data as $row) {
            $rowData = array_combine($headers, $row);

            Product::create([
                'name' => $rowData['ProductName'],
                'category' => $rowData['Category'],
            ]);
        }

        $this->info('CSV data imported successfully!');
        return 0;
    }
}
