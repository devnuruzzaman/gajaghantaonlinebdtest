<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Spatie\Permission\Models\Permission;

// Get admin user
$admin = User::where('email', 'admin@isp.local')->first();

if($admin) {
    // Get all permissions
    $permissions = Permission::all()->pluck('name')->toArray();
    
    // Give admin all permissions
    $admin->givePermissionTo($permissions);
    
    echo "Admin user '{$admin->name}' has been given all permissions\n";
    echo "Total permissions: " . count($permissions) . "\n";
    echo "Admin can now access all features!\n";
} else {
    echo "Admin user not found\n";
}
