<?php

use App\Models\User;

$user = User::where('email', 'admin@isp.local')->first();
if ($user) {
    $user->password = bcrypt('password');
    $user->save();
    echo "Password reset successfully for admin@isp.local\n";
} else {
    echo "User not found\n";
}
