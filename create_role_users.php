<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Spatie\Permission\Models\Role;
use App\Models\User;

// Create roles if they don't exist
$roles = ['admin', 'employee', 'reseller', 'client'];

foreach ($roles as $roleName) {
    $role = Role::firstOrCreate(['name' => $roleName]);
    echo "Role '{$roleName}' created/exists\n";
}

// Create test users for each role
$testUsers = [
    [
        'name' => 'Admin User',
        'email' => 'admin@isp.local',
        'password' => 'password',
        'role' => 'admin'
    ],
    [
        'name' => 'Employee User',
        'email' => 'employee@isp.local',
        'password' => 'password',
        'role' => 'employee'
    ],
    [
        'name' => 'Reseller User',
        'email' => 'reseller@isp.local',
        'password' => 'password',
        'role' => 'reseller'
    ],
    [
        'name' => 'Client User',
        'email' => 'client@isp.local',
        'password' => 'password',
        'role' => 'client'
    ]
];

foreach ($testUsers as $userData) {
    $user = User::firstOrCreate(
        ['email' => $userData['email']],
        [
            'name' => $userData['name'],
            'password' => bcrypt($userData['password']),
            'email_verified_at' => now(),
        ]
    );
    
    $user->assignRole($userData['role']);
    echo "User '{$userData['name']}' with role '{$userData['role']}' created/exists\n";
}

echo "\nTest Users Created:\n";
echo "Admin: admin@isp.local / password\n";
echo "Employee: employee@isp.local / password\n";
echo "Reseller: reseller@isp.local / password\n";
echo "Client: client@isp.local / password\n";
