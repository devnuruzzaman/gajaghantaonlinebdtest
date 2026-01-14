<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Create sample packages
$packages = [
    [
        'name' => 'Basic 5Mbps',
        'description' => 'Basic internet package for home users',
        'price' => 500,
        'download_speed' => 5,
        'upload_speed' => 2,
        'type' => 'pppoe',
        'status' => 'active',
        'validity_days' => 30,
    ],
    [
        'name' => 'Standard 10Mbps',
        'description' => 'Standard package for small offices',
        'price' => 1000,
        'download_speed' => 10,
        'upload_speed' => 5,
        'type' => 'pppoe',
        'status' => 'active',
        'validity_days' => 30,
    ],
    [
        'name' => 'Premium 20Mbps',
        'description' => 'High-speed package for businesses',
        'price' => 2000,
        'download_speed' => 20,
        'upload_speed' => 10,
        'type' => 'pppoe',
        'status' => 'active',
        'validity_days' => 30,
    ],
];

foreach ($packages as $packageData) {
    App\Models\Package::firstOrCreate(['name' => $packageData['name']], $packageData);
}

// Create sample router
$router = App\Models\Router::firstOrCreate([
    'ip_address' => '192.168.1.1'
], [
    'name' => 'Main Router',
    'username' => 'admin',
    'password' => 'password',
    'port' => 8728,
    'type' => 'mikrotik',
    'description' => 'Main MikroTik router',
    'status' => 'online',
]);

echo "Sample data created successfully!\n";
echo "Packages: " . App\Models\Package::count() . "\n";
echo "Routers: " . App\Models\Router::count() . "\n";
