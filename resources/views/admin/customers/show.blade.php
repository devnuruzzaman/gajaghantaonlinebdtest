@extends('layouts.admin')

@section('title', 'Customer Details')
@section('breadcrumb', 'Customer Details')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Customer Information</h3>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <img src="https://via.placeholder.com/100x100" class="img-circle" alt="User Image">
                </div>
                <h5 class="text-center">{{ $customer->name }}</h5>
                <p class="text-center text-muted">{{ $customer->status_badge }}</p>
                
                <table class="table table-sm">
                    <tr>
                        <td><strong>Username:</strong></td>
                        <td>{{ $customer->username }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td>{{ $customer->phone }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $customer->email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Address:</strong></td>
                        <td>{{ $customer->address ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Service Details</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-default btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Package:</strong></label>
                            <p>{{ $customer->package?->name ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><strong>Router:</strong></label>
                            <p>{{ $customer->router?->name ?? 'N/A' }} ({{ $customer->router?->ip_address ?? 'N/A' }})</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>Connection Date:</strong></label>
                            <p>{{ $customer->connection_date?->format('M d, Y') ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>Expiry Date:</strong></label>
                            <p>
                                {{ $customer->expiry_date?->format('M d, Y') ?? 'N/A' }}
                                @if($customer->is_expiring_soon())
                                    <span class="text-danger">(Expires Soon)</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><strong>Monthly Fee:</strong></label>
                            <p>৳{{ number_format($customer->monthly_fee, 2) }}</p>
                        </div>
                    </div>
                </div>
                
                @if($customer->notes)
                <div class="form-group">
                    <label><strong>Notes:</strong></label>
                    <p>{{ $customer->notes }}</p>
                </div>
                @endif
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Connection Status</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-calendar"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Days Until Expiry</span>
                                <span class="info-box-number">{{ $customer->days_until_expiry }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon @if($customer->is_expired()) bg-danger @else bg-success @endif">
                                <i class="fas fa-wifi"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Connection Status</span>
                                <span class="info-box-number">
                                    @if($customer->is_expired()) 
                                        Expired 
                                    @else 
                                        Active 
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
