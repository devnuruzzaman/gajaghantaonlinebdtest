<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Router;
use Illuminate\Http\Request;

class RouterController extends Controller
{
    public function index()
    {
        $routers = Router::withCount('customers')->latest()->paginate(10);
        return view('admin.routers.index', compact('routers'));
    }

    public function create()
    {
        return view('admin.routers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ip_address' => 'required|ip|unique:routers,ip_address',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'port' => 'required|integer|min:1|max:65535',
            'type' => 'required|in:mikrotik,cisco,other',
            'description' => 'nullable|string',
            'status' => 'required|in:online,offline,error',
            'notes' => 'nullable|string',
        ]);

        Router::create($validated);

        return redirect()->route('admin.routers.index')
            ->with('success', 'Router created successfully.');
    }

    public function show(Router $router)
    {
        $router->load('customers');
        return view('admin.routers.show', compact('router'));
    }

    public function edit(Router $router)
    {
        return view('admin.routers.edit', compact('router'));
    }

    public function update(Request $request, Router $router)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ip_address' => 'required|ip|unique:routers,ip_address,' . $router->id,
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            'port' => 'required|integer|min:1|max:65535',
            'type' => 'required|in:mikrotik,cisco,other',
            'description' => 'nullable|string',
            'status' => 'required|in:online,offline,error',
            'notes' => 'nullable|string',
        ]);

        if (!$request->filled('password')) {
            unset($validated['password']);
        }

        $router->update($validated);

        return redirect()->route('admin.routers.index')
            ->with('success', 'Router updated successfully.');
    }

    public function destroy(Router $router)
    {
        if ($router->customers()->count() > 0) {
            return redirect()->route('admin.routers.index')
                ->with('error', 'Cannot delete router. It has associated customers.');
        }

        $router->delete();

        return redirect()->route('admin.routers.index')
            ->with('success', 'Router deleted successfully.');
    }
}
