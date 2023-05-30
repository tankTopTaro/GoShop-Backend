<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from FakeStoreAPI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://fakestoreapi.com/products');

        if ($response->ok()) {
            $products = $response->json();

            foreach ($products as $productData) {
                $ratingData = $productData['rating'];
                unset($productData['rating']);

                $product = new Product();
                $product->title = $productData['title'];
                $product->category = $productData['category'];
                $product->description = $productData['description'];
                $product->price = $productData['price'];
                $product->image = $productData['image'];
                $product->rating = json_encode($ratingData);
                $product->save();
            }
            
            $this->info('Products imported successfully!');
        } else {
            $this->error('Failed to import products!');
        }
    }
}
