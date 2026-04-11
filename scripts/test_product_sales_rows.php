<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$purchasePriceExpr = 'COALESCE(products.purchase_price, products.wholesale_price, 0)';
$salePriceExpr = 'COALESCE(products.sale_price, products.price, 0)';
$totalQtyExpr = 'COALESCE(SUM(CASE WHEN orders.id IS NOT NULL THEN carts.quantity ELSE 0 END), 0)';
$totalPriceExpr = '(' . $salePriceExpr . ' * ' . $totalQtyExpr . ')';

$rows = DB::table('products')
    ->leftJoin('carts', 'carts.product_id', '=', 'products.id')
    ->leftJoin('orders', function ($join) {
        $join->on('orders.id', '=', 'carts.order_id')
            ->where('orders.status', '=', 'delivered');
    })
    ->select(
        'products.id as product_id',
        'products.title as product',
        DB::raw($purchasePriceExpr . ' as purchase_price'),
        DB::raw($salePriceExpr . ' as sale_price'),
        DB::raw($totalQtyExpr . ' as total_qty'),
        DB::raw($totalPriceExpr . ' as total_price'),
        DB::raw('(' . $totalPriceExpr . ' - (' . $purchasePriceExpr . ' * ' . $totalQtyExpr . ')) as profit')
    )
    ->groupBy('products.id', 'products.title', 'products.purchase_price', 'products.wholesale_price', 'products.sale_price', 'products.price')
    ->orderByDesc('total_price')
    ->limit(5)
    ->get();

echo json_encode($rows, JSON_PRETTY_PRINT) . PHP_EOL;
