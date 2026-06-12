<?php

declare(strict_types=1);

use App\Models\Product;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Str;

require __DIR__ . '/../vendor/autoload.php';

$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Kernel::class)->bootstrap();

$productDir = storage_path('app/public/products');

if (!is_dir($productDir)) {
    fwrite(STDERR, "Folder products tidak ditemukan: {$productDir}" . PHP_EOL);
    exit(1);
}

$availableFiles = [];
foreach (scandir($productDir) ?: [] as $file) {
    if ($file === '.' || $file === '..') {
        continue;
    }

    $path = $productDir . DIRECTORY_SEPARATOR . $file;
    if (!is_file($path)) {
        continue;
    }

    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'], true)) {
        continue;
    }

    $nameWithoutExt = strtolower(pathinfo($file, PATHINFO_FILENAME));
    $availableFiles[$nameWithoutExt] = $file;
}

$slugOverrides = [
    'xiaomi-14' => 'xiaomi-14-pro.jpg',
    'redmi-buds-5-pro' => 'redmi-buds-5.jpg',
];

$updated = 0;
$skipped = 0;

/** @var Product $product */
foreach (Product::query()->get() as $product) {
    $slug = Str::slug($product->name);
    $matched = $slugOverrides[$slug] ?? ($availableFiles[$slug] ?? null);

    if (!$matched) {
        $skipped++;
        echo "SKIP  - {$product->name} (tidak ada file cocok untuk slug: {$slug})" . PHP_EOL;
        continue;
    }

    $newPath = 'products/' . $matched;
    if ($product->image === $newPath) {
        echo "OK    - {$product->name} => {$newPath}" . PHP_EOL;
        continue;
    }

    $product->image = $newPath;
    $product->save();
    $updated++;

    echo "UPDATE- {$product->name} => {$newPath}" . PHP_EOL;
}

echo PHP_EOL . "Selesai. Updated: {$updated}, Skipped: {$skipped}" . PHP_EOL;
