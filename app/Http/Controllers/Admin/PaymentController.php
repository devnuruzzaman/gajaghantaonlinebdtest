<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with(['customer'])->latest()->paginate(15);

        $openInvoices = Invoice::with(['customer'])
            ->where(function ($q) {
                $q->whereNull('due_amount')->orWhere('due_amount', '>', 0);
            })
            ->latest()
            ->limit(200)
            ->get();

        return view('admin.billing.payments.index', compact('payments', 'openInvoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_id' => ['required', 'integer', 'exists:invoices,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'paid_at' => ['nullable', 'date'],
            'method' => ['nullable', 'string', 'max:50'],
            'reference' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        return DB::transaction(function () use ($validated) {
            $invoice = Invoice::lockForUpdate()->findOrFail((int) $validated['invoice_id']);

            $amount = (float) $validated['amount'];
            $paidAt = $validated['paid_at'] ?? now();

            Payment::create([
                'invoice_id' => $invoice->id,
                'customer_id' => $invoice->customer_id,
                'amount' => $amount,
                'paid_at' => $paidAt,
                'method' => $validated['method'] ?? null,
                'reference' => $validated['reference'] ?? null,
                'notes' => $validated['notes'] ?? null,
            ]);

            $newPaid = (float) ($invoice->paid_amount ?? 0) + $amount;
            $newDue = max(0, (float) ($invoice->due_amount ?? 0) - $amount);

            $invoice->paid_amount = $newPaid;
            $invoice->due_amount = $newDue;
            $invoice->status = $newDue <= 0 ? 'paid' : 'partial';
            $invoice->save();

            return redirect()->route('admin.payments.index')
                ->with('success', 'Payment saved successfully.');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
