@extends('layouts.admin')

@section('title', 'Invoices')
@section('breadcrumb', 'Invoices')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Invoices</h3>
                <div class="card-tools">
                    @can('billing.create')
                    <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Generate Invoice
                    </a>
                    @endcan
                </div>
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

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer</th>
                                <th>Billing Month</th>
                                <th class="text-right">Amount</th>
                                <th class="text-right">Tax</th>
                                <th class="text-right">Discount</th>
                                <th class="text-right">Paid</th>
                                <th class="text-right">Due</th>
                                <th>Status</th>
                                <th>Issued</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoices as $inv)
                                <tr>
                                    <td>{{ $inv->id }}</td>
                                    <td>{{ $inv->customer?->name ?? 'N/A' }}</td>
                                    <td>{{ $inv->billing_month?->format('Y-m-d') ?? '-' }}</td>
                                    <td class="text-right">{{ number_format((float) $inv->amount, 2) }}</td>
                                    <td class="text-right">{{ number_format((float) ($inv->tax_amount ?? 0), 2) }}</td>
                                    <td class="text-right">{{ number_format((float) ($inv->discount ?? 0), 2) }}</td>
                                    <td class="text-right">{{ number_format((float) ($inv->paid_amount ?? 0), 2) }}</td>
                                    <td class="text-right">{{ number_format((float) ($inv->due_amount ?? 0), 2) }}</td>
                                    <td>{{ strtoupper((string) $inv->status) }}</td>
                                    <td>{{ $inv->issued_at?->format('Y-m-d') ?? ($inv->created_at?->format('Y-m-d') ?? '-') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center text-muted">No invoices found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
