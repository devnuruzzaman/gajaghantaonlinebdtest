<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the welcome page with active packages.
     */
    public function welcome()
    {
        $packages = [];

        if (Schema::hasTable('packages')) {
            $packages = Package::query()
                ->where('status', 'active')
                ->orderBy('price')
                ->get();
        }

        return view('welcome', compact('packages'));
    }

    /**
     * Redirect to welcome page.
     */
    public function home()
    {
        return redirect()->route('welcome');
    }

    /**
     * Display the login page.
     */
    public function login()
    {
        return view('auth.auth');
    }
}
