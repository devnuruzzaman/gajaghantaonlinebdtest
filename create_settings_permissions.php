<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Add settings permissions
use Spatie\Permission\Models\Permission;

$permissions = [
    'settings.view',
    'settings.edit',
];

foreach ($permissions as $permission) {
    Permission::firstOrCreate(['name' => $permission]);
}

// Add default settings
App\Models\Setting::set('site_name', 'ISP Management System', 'text', 'general');
App\Models\Setting::set('site_description', 'Complete ISP Management and Billing Solution', 'text', 'general');

echo "Settings permissions and default values created successfully!\n";
