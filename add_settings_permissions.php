<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = App\Models\User::where('email', 'nuruzzamanbce1@gmail.com')->first();

if($user) {
    $user->givePermissionTo(['settings.view', 'settings.edit']);
    echo "Settings permissions added to user: {$user->name}\n";
} else {
    echo "User not found\n";
}
