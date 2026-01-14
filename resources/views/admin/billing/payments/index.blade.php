@extends('layouts.admin')

@section('title', 'Payments')
@section('breadcrumb', 'Payments')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Record Payment</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.payments.store') }}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Invoice</label>
                            <select name="invoice_id" class="form-control" required>
                                <option value="">Select Invoice</option>
                                @foreach($openInvoices as $inv)
                                    <option value="{{ $inv->id }}">
                                        #{{ $inv->id }} - {{ $inv->customer?->name ?? 'N/A' }} (Due {{ number_format((float) ($inv->due_amount ?? 0), 2) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Amount</label>
                            <input type="number" step="0.01" min="0.01" name="amount" class="form-control" value="{{ old('amount') }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Paid At</label>
                            <input type="datetime-local" name="paid_at" class="form-control" value="{{ old('paid_at') }}">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Method</label>
                            <input type="text" name="method" class="form-control" value="{{ old('method') }}" placeholder="Cash / Bkash / Bank">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Reference</label>
                            <input type="text" name="reference" class="form-control" value="{{ old('reference') }}" placeholder="Txn ID / Ref">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Notes</label>
                            <input type="text" name="notes" class="form-control" value="{{ old('notes') }}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Payment
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Payments</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Invoice</th>
                                <th>Customer</th>
                                <th class="text-right">Amount</th>
                                <th>Paid At</th>
                                <th>Method</th>
                                <th>Reference</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($payments as $p)
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>#{{ $p->invoice_id }}</td>
                                    <td>{{ $p->customer?->name ?? 'N/A' }}</td>
                                    <td class="text-right">{{ number_format((float) $p->amount, 2) }}</td>
                                    <td>{{ $p->paid_at?->format('Y-m-d H:i') ?? ($p->created_at?->format('Y-m-d H:i') ?? '-') }}</td>
                                    <td>{{ $p->method ?? '-' }}</td>
                                    <td>{{ $p->reference ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No payments found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $payments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
