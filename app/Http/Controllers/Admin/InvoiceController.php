<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::with(['customer'])->latest()->paginate(15);
        return view('admin.billing.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::select(['id', 'name', 'phone'])->orderBy('name')->get();
        $taxRatePercent = (float) Setting::get('tax_rate_percent', 0);
        $defaultBillingMonth = now()->startOfMonth()->toDateString();

        return view('admin.billing.invoices.create', compact('customers', 'taxRatePercent', 'defaultBillingMonth'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        $validated = $request->validated();

        return DB::transaction(function () use ($validated) {
            $amount = (float) ($validated['amount'] ?? 0);
            $discount = (float) ($validated['discount'] ?? 0);

            $taxRatePercent = (float) Setting::get('tax_rate_percent', 0);
            $taxAmount = array_key_exists('tax_amount', $validated) && $validated['tax_amount'] !== null
                ? (float) $validated['tax_amount']
                : ($amount * $taxRatePercent) / 100;

            $gross = max(0, $amount + $taxAmount - $discount);

            Invoice::create([
                'customer_id' => (int) $validated['customer_id'],
                'billing_month' => $validated['billing_month'],
                'amount' => $amount,
                'tax_amount' => $taxAmount,
                'discount' => $discount,
                'paid_amount' => 0,
                'due_amount' => $gross,
                'status' => $gross <= 0 ? 'paid' : 'unpaid',
                'issued_at' => now()->toDateString(),
                'due_date' => now()->addDays(7)->toDateString(),
                'notes' => $validated['notes'] ?? null,
            ]);

            return redirect()->route('admin.invoices.index')
                ->with('success', 'Invoice created successfully.');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
