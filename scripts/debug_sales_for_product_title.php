<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use Illuminate\Support\Facades\DB;

$title = $argv[1] ?? 'hi';

$product = Product::where('title', $title)->orderByDesc('id')->first();
if (!$product) {
    fwrite(STDERR, "Product not found for title: {$title}\n");
    exit(1);
}

$delivered = DB::table('carts')
    ->join('orders', 'orders.id', '=', 'carts.order_id')
    ->where('orders.status', '=', 'delivered')
    ->where('carts.product_id', '=', $product->id)
    ->selectRaw('COALESCE(SUM(carts.quantity),0) as qty, COALESCE(SUM(carts.amount),0) as amount, COUNT(*) as row_count')
    ->first();

$out = [
    'product_id' => $product->id,
    'title' => $product->title,
    'stock' => $product->stock,
    'purchase_price' => $product->purchase_price,
    'sale_price' => $product->sale_price,
    'legacy_price' => $product->getRawOriginal('price'),
    'delivered_cart_rows' => (int)($delivered->row_count ?? 0),
    'delivered_qty' => (int)($delivered->qty ?? 0),
    'delivered_amount_sum' => (float)($delivered->amount ?? 0),
];

echo json_encode($out, JSON_PRETTY_PRINT) . PHP_EOL;
