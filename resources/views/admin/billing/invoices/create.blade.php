@extends('layouts.admin')

@section('title', 'Generate Invoice')
@section('breadcrumb', 'Generate Invoice')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Generate Invoice</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary btn-sm">Back</a>
                </div>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.invoices.store') }}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Customer</label>
                            <select name="customer_id" class="form-control" required>
                                <option value="">Select Customer</option>
                                @foreach($customers as $c)
                                    <option value="{{ $c->id }}" @selected(old('customer_id') == $c->id)>
                                        {{ $c->name }} ({{ $c->phone }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Billing Month</label>
                            <input type="date" name="billing_month" class="form-control" value="{{ old('billing_month', $defaultBillingMonth) }}" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Amount</label>
                            <input id="amount" type="number" step="0.01" min="0" name="amount" class="form-control" value="{{ old('amount') }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Tax Amount</label>
                            <input id="tax_amount" type="number" step="0.01" min="0" name="tax_amount" class="form-control" value="{{ old('tax_amount', '0') }}">
                            <small class="text-muted">Default tax rate: {{ number_format((float) $taxRatePercent, 2) }}%</small>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Discount</label>
                            <input type="number" step="0.01" min="0" name="discount" class="form-control" value="{{ old('discount', '0') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Notes</label>
                        <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Invoice
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
(function () {
    var amount = document.getElementById('amount');
    var tax = document.getElementById('tax_amount');
    if (!amount || !tax) return;

    var rate = {{ (float) $taxRatePercent }};

    function recalc() {
        var a = parseFloat(amount.value || '0');
        if (isNaN(a)) a = 0;
        var t = (a * rate) / 100;
        if (!tax.value || parseFloat(tax.value) === 0) {
            tax.value = t.toFixed(2);
        }
    }

    amount.addEventListener('input', recalc);
})();
</script>
@endsection
