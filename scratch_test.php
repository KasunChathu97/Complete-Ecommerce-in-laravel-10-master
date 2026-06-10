<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

try {
    $product = App\Models\Product::where('slug', 'solar-charger-controller-pwm-10a')->first();
    if (!$product) {
        throw new Exception("Product not found");
    }
    $html = view('frontend.pages.product_detail', ['product_detail' => $product])->render();
    echo "SUCCESS: Blade rendered correctly. HTML length: " . strlen($html) . "\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
}
