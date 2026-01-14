<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = new App\Models\User();
$user->name = 'Test Admin';
$user->email = 'test@isp.local';
$user->password = bcrypt('123456');
$user->save();
$user->assignRole('admin');

echo "New admin user created:\n";
echo "Email: test@isp.local\n";
echo "Password: 123456\n";
