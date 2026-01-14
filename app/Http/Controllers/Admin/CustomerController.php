<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Package;
use App\Models\Router;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with(['package', 'router'])->latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        $packages = Package::where('status', 'active')->get();
        $routers = Router::where('status', 'online')->get();
        return view('admin.customers.create', compact('packages', 'routers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email',
            'phone' => 'required|string|unique:customers,phone',
            'address' => 'nullable|string',
            'username' => 'required|string|unique:customers,username',
            'password' => 'required|string|min:6',
            'package_id' => 'required|exists:packages,id',
            'router_id' => 'required|exists:routers,id',
            'status' => 'required|in:active,inactive,suspended,expired',
            'connection_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:connection_date',
            'monthly_fee' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        
        Customer::create($validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        $customer->load(['package', 'router']);
        return view('admin.customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $packages = Package::where('status', 'active')->get();
        $routers = Router::all();
        return view('admin.customers.edit', compact('customer', 'packages', 'routers'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|unique:customers,phone,' . $customer->id,
            'address' => 'nullable|string',
            'username' => 'required|string|unique:customers,username,' . $customer->id,
            'package_id' => 'required|exists:packages,id',
            'router_id' => 'required|exists:routers,id',
            'status' => 'required|in:active,inactive,suspended,expired',
            'connection_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after_or_equal:connection_date',
            'monthly_fee' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $customer->update($validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}
