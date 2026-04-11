<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

$category = Category::orderBy('id')->first();
if (!$category) {
    fwrite(STDERR, "No categories found. Cannot create product.\n");
    exit(1);
}

$now = time();

$data = [
    'title' => 'CLI Test Product ' . $now,
    'slug' => Str::slug('cli-test-product-' . $now),
    'summary' => 'CLI inserted product',
    'description' => 'Inserted via scripts/test_create_product.php',
    'photo' => '/storage/products/test.jpg',
    'stock' => 5,
    'size' => '',
    'condition' => 'default',
    'status' => 'active',
    'price' => 999,
    'discount' => 0,
    'is_featured' => 0,
    'cat_id' => $category->id,
];

if (Schema::hasColumn('products', 'sale_price')) {
    $data['sale_price'] = 999;
}

if (Schema::hasColumn('products', 'purchase_price')) {
    $data['purchase_price'] = 500;
}

$product = Product::create($data);

echo 'CREATED_ID=' . $product->id . PHP_EOL;

$columns = ['id', 'title', 'price', 'created_at'];
if (Schema::hasColumn('products', 'sale_price')) {
    $columns[] = 'sale_price';
}
if (Schema::hasColumn('products', 'purchase_price')) {
    $columns[] = 'purchase_price';
}

$row = DB::table('products')
    ->select($columns)
    ->where('id', $product->id)
    ->first();

echo 'DB_ROW=' . json_encode($row) . PHP_EOL;
